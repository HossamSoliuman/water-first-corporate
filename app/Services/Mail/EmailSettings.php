<?php

namespace App\Services\Mail;

use App\Enums\EmailType;
use App\Models\Setting;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

/**
 * Reads and writes the admin-managed email configuration stored in the
 * shared `settings` table (group "mail"). Every key is prefixed `mail_`;
 * the generic Site Settings form refuses that prefix so credentials can only
 * change through the validated Email Settings screens.
 *
 * Credentials are encrypted with the application key (APP_KEY) and are only
 * ever decrypted here, at send time.
 */
class EmailSettings
{
    public const PREFIX = 'mail_';

    /** @var array<int, string> */
    public const ENCRYPTED = ['mail_smtp_username', 'mail_smtp_password'];

    /** @var array<string, string> */
    private const TYPES = [
        'mail_smtp_enabled' => 'boolean',
        'mail_admin_enabled' => 'boolean',
        'mail_ack_enabled' => 'boolean',
        'mail_admin_recipients' => 'json',
        'mail_admin_cc' => 'json',
        'mail_admin_bcc' => 'json',
        'mail_admin_body' => 'textarea',
        'mail_ack_body' => 'textarea',
        'mail_ack_company_details' => 'textarea',
    ];

    public function get(string $key): mixed
    {
        $value = Setting::get($key);

        if ($value === null || $value === '') {
            return self::defaults()[$key] ?? $value;
        }

        if (in_array($key, self::ENCRYPTED, true)) {
            return $this->decrypt($key, $value);
        }

        return $value;
    }

    public function bool(string $key): bool
    {
        return filter_var($this->get($key), FILTER_VALIDATE_BOOL);
    }

    /**
     * @param  array<string, mixed>  $values
     */
    public function put(array $values): void
    {
        foreach ($values as $key => $value) {
            $type = self::TYPES[$key] ?? 'text';

            $stored = match (true) {
                $type === 'boolean' => $value ? '1' : '0',
                $type === 'json' => json_encode(array_values($value ?? [])),
                in_array($key, self::ENCRYPTED, true) => filled($value) ? Crypt::encryptString((string) $value) : null,
                default => $value,
            };

            Setting::updateOrCreate(['key' => $key], ['value' => $stored, 'group' => 'mail', 'type' => $type]);
            Cache::forget("setting_{$key}");
        }
    }

    public function hasPassword(): bool
    {
        return filled(Setting::get('mail_smtp_password'));
    }

    /**
     * @return array{enabled: bool, host: ?string, port: int, encryption: string, username: ?string, password: ?string, timeout: int, from_address: ?string, from_name: ?string}
     */
    public function smtp(): array
    {
        return [
            'enabled' => $this->bool('mail_smtp_enabled'),
            'host' => $this->get('mail_smtp_host'),
            'port' => (int) $this->get('mail_smtp_port'),
            'encryption' => (string) $this->get('mail_smtp_encryption'),
            'username' => $this->get('mail_smtp_username'),
            'password' => $this->get('mail_smtp_password'),
            'timeout' => (int) $this->get('mail_smtp_timeout'),
            'from_address' => $this->get('mail_from_address'),
            'from_name' => $this->get('mail_from_name'),
        ];
    }

    /**
     * @return array{to: array<int, string>, cc: array<int, string>, bcc: array<int, string>}
     */
    public function recipients(): array
    {
        return [
            'to' => array_values(array_filter((array) $this->get('mail_admin_recipients'))),
            'cc' => array_values(array_filter((array) $this->get('mail_admin_cc'))),
            'bcc' => array_values(array_filter((array) $this->get('mail_admin_bcc'))),
        ];
    }

    public function isEnabled(EmailType $type): bool
    {
        return match ($type) {
            EmailType::AdminNotification => $this->bool('mail_admin_enabled'),
            EmailType::CustomerAcknowledgement => $this->bool('mail_ack_enabled'),
            EmailType::Test => true,
        };
    }

    /**
     * The editable template fields for one email type.
     *
     * @return array<string, string>
     */
    public function template(EmailType $type): array
    {
        $prefix = self::templatePrefix($type);

        return collect(self::templateFields($type))
            ->mapWithKeys(fn (string $field) => [$field => (string) $this->get($prefix.$field)])
            ->all();
    }

    public static function templatePrefix(EmailType $type): string
    {
        return match ($type) {
            EmailType::AdminNotification => 'mail_admin_',
            default => 'mail_ack_',
        };
    }

    /**
     * @return array<int, string>
     */
    public static function templateFields(EmailType $type): array
    {
        $common = ['subject', 'heading', 'body', 'footer', 'button_text'];

        return $type === EmailType::CustomerAcknowledgement
            ? [...$common, 'from_name', 'company_details', 'button_url']
            : $common;
    }

    /**
     * First-run defaults, used until an administrator saves their own values.
     * Brand details are placeholders resolved from Site Settings.
     *
     * @return array<string, mixed>
     */
    public static function defaults(): array
    {
        return [
            'mail_smtp_enabled' => false,
            'mail_smtp_port' => 587,
            'mail_smtp_encryption' => 'tls',
            'mail_smtp_timeout' => 30,

            'mail_admin_enabled' => true,
            'mail_admin_recipients' => [],
            'mail_admin_cc' => [],
            'mail_admin_bcc' => [],
            'mail_admin_subject' => 'New website enquiry from {{name}}',
            'mail_admin_heading' => 'New contact form submission',
            'mail_admin_body' => "<p>A new enquiry was submitted on the {{company_name}} website on {{submission_date}}.</p>\n"
                ."<p><strong>Name:</strong> {{name}}<br>\n<strong>Email:</strong> {{email}}<br>\n<strong>Phone:</strong> {{phone}}<br>\n"
                ."<strong>Organisation:</strong> {{company}}<br>\n<strong>Subject:</strong> {{subject}}<br>\n<strong>Form:</strong> {{form_type}}</p>\n"
                ."<p><strong>Message:</strong><br>\n{{message}}</p>\n"
                .'<p>Reply to this email to respond to {{name}} directly.</p>',
            'mail_admin_footer' => 'This notification was generated automatically by the {{company_name}} website.',
            'mail_admin_button_text' => 'View enquiry in admin panel',

            'mail_ack_enabled' => true,
            'mail_ack_subject' => 'Thank You for Contacting {{company_name}}',
            'mail_ack_heading' => 'Thank you for getting in touch',
            'mail_ack_body' => "<p>Dear {{name}},</p>\n"
                ."<p>Thank you for contacting {{company_name}}.</p>\n"
                ."<p>We have successfully received your enquiry. Our team will review your request and get back to you as soon as possible.</p>\n"
                ."<p>For your reference, your submitted enquiry was:</p>\n"
                ."<p><strong>Subject:</strong> {{subject}}<br>\n<strong>Message:</strong><br>\n{{message}}</p>\n"
                ."<p>We appreciate your interest in {{company_name}}.</p>\n"
                .'<p>Best regards,<br>{{company_name}} Team</p>',
            'mail_ack_footer' => 'You are receiving this email because you submitted the contact form on our website.',
            'mail_ack_from_name' => '',
            'mail_ack_company_details' => "{{company_name}}\n{{company_email}}  {{company_phone}}",
            'mail_ack_button_text' => '',
            'mail_ack_button_url' => '',
        ];
    }

    private function decrypt(string $key, string $value): ?string
    {
        try {
            return Crypt::decryptString($value);
        } catch (DecryptException) {
            Log::warning("Stored {$key} could not be decrypted (APP_KEY changed?). Re-enter it in Email Settings.");

            return null;
        }
    }
}
