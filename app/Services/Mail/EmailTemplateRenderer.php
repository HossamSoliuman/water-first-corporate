<?php

namespace App\Services\Mail;

use App\Enums\EmailType;
use App\Models\Lead;
use App\Models\Setting;
use Illuminate\Support\Str;

/**
 * Turns an admin-edited template plus a contact submission into a
 * {@see RenderedEmail}.
 *
 * Safety model: the template body is passed through HTML Purifier (an email
 * allow-list); every other template field is plain text and HTML-escaped.
 * Placeholder values come from the public form and are always HTML-escaped
 * before insertion, and the subject is flattened to one line so visitor
 * input can never inject headers.
 */
class EmailTemplateRenderer
{
    /**
     * Placeholders every template can use, with a short description for the editor.
     *
     * @var array<string, string>
     */
    public const PLACEHOLDERS = [
        'name' => 'Visitor’s full name',
        'email' => 'Visitor’s email address',
        'phone' => 'Visitor’s phone number',
        'company' => 'Visitor’s organisation',
        'subject' => 'Project / subject entered on the form',
        'message' => 'Visitor’s message',
        'form_type' => 'Which form was used (Contact, Inquiry …)',
        'submission_date' => 'Date and time of the submission',
        'company_name' => 'Your site name (Site Settings)',
        'company_email' => 'Your contact email (Site Settings)',
        'company_phone' => 'Your phone number (Site Settings)',
        'company_website' => 'Your website address',
    ];

    /** Placeholders only offered in the internal notification. */
    public const ADMIN_PLACEHOLDERS = [
        'admin_url' => 'Link to this enquiry in the admin panel',
    ];

    /** Dates in emails, shown in config('app.display_timezone'): "12 Oct 2026, 22:15 IST". */
    public const DATE_FORMAT = 'd M Y, H:i T';

    /** @var array<string, mixed> */
    private const PURIFIER = [
        'HTML.Doctype' => 'XHTML 1.0 Transitional',
        'HTML.Allowed' => 'p,br,strong,b,em,i,u,a[href|title],ul,ol,li,blockquote,h2,h3,h4,span[style],hr',
        'CSS.AllowedProperties' => 'color,font-weight,font-style,text-decoration,text-align',
        'URI.AllowedSchemes' => ['http' => true, 'https' => true, 'mailto' => true, 'tel' => true],
        'AutoFormat.AutoParagraph' => false,
        'AutoFormat.RemoveEmpty' => true,
    ];

    public function __construct(
        private EmailSettings $settings,
        private DynamicMailer $mailer,
    ) {}

    /**
     * @param  array<string, string>|null  $template  unsaved values to preview; defaults to the saved template
     */
    public function render(EmailType $type, Lead $lead, ?array $template = null): RenderedEmail
    {
        $template = array_merge($this->settings->template($type), $template ?? []);
        $values = $this->placeholderValues($type, $lead);
        $isAcknowledgement = $type === EmailType::CustomerAcknowledgement;

        [$buttonText, $buttonUrl] = $isAcknowledgement
            ? [$template['button_text'] ?? '', $template['button_url'] ?? '']
            : [$template['button_text'] ?? '', $values['admin_url']];

        $hasButton = filled($buttonText) && filled($buttonUrl) && preg_match('#^https?://#i', $buttonUrl);

        $headingHtml = $this->plainToHtml($template['heading'] ?? '', $values);
        $bodyHtml = $this->bodyToHtml($template['body'] ?? '', $values);
        $footerHtml = $this->plainToHtml($template['footer'] ?? '', $values);
        $companyHtml = $isAcknowledgement ? $this->plainToHtml($template['company_details'] ?? '', $values) : '';
        $from = $this->mailer->from($isAcknowledgement ? $this->replace($template['from_name'] ?? '', $values) : null);

        return new RenderedEmail(
            subject: Str::limit(DynamicMailer::singleLine($this->replace($template['subject'] ?? '', $values)), 250, '…'),
            headingHtml: $headingHtml,
            bodyHtml: $bodyHtml,
            footerHtml: $footerHtml,
            companyDetailsHtml: $companyHtml,
            buttonText: $hasButton ? DynamicMailer::singleLine($this->replace($buttonText, $values)) : null,
            buttonUrl: $hasButton ? $buttonUrl : null,
            text: $this->plainText($headingHtml, $bodyHtml, $hasButton ? [$buttonText, $buttonUrl] : null, $companyHtml, $footerHtml, $values),
            fromAddress: $from['address'],
            fromName: $from['name'],
            replyToAddress: $isAcknowledgement ? null : $lead->email,
            replyToName: $isAcknowledgement ? null : DynamicMailer::singleLine((string) $lead->name),
        );
    }

    /**
     * The fixed message used by "Send test email" to verify the transport.
     */
    public function test(string $transport): RenderedEmail
    {
        $siteName = (string) (Setting::get('site_name') ?: config('app.name'));
        $sentAt = now()->inDisplayTimezone()->format(self::DATE_FORMAT);
        $from = $this->mailer->from();

        return new RenderedEmail(
            subject: "SMTP test email from {$siteName}",
            headingHtml: 'Your email settings work',
            bodyHtml: '<p>This test message was sent from the '.e($siteName).' admin panel on '.e($sentAt).' using the <strong>'.e($transport).'</strong> mailer.</p>'
                .'<p>If you are reading this, contact form notifications and auto-replies can be delivered to this mailbox.</p>',
            footerHtml: 'Sent from Admin → Email Settings.',
            companyDetailsHtml: '',
            buttonText: null,
            buttonUrl: null,
            text: "Your email settings work\n\nThis test message was sent from the {$siteName} admin panel on {$sentAt} using the {$transport} mailer.",
            fromAddress: $from['address'],
            fromName: $from['name'],
        );
    }

    /**
     * Sanitises an admin-supplied HTML body for storage. Plain text passes through.
     */
    public function sanitizeBody(string $body): string
    {
        return $this->containsHtml($body) ? trim(clean($body, self::PURIFIER)) : trim($body);
    }

    /**
     * A realistic but fictional submission used for previews and test sends.
     */
    public function sampleLead(?string $email = null): Lead
    {
        $lead = new Lead([
            'form_type' => 'contact',
            'name' => 'Asha Rao',
            'email' => $email ?: 'asha.rao@example.com',
            'phone' => '+91 98450 00000',
            'company' => 'Example Water Utility',
            'subject' => 'Wastewater treatment plant upgrade',
            'message' => "Hello,\nWe are planning a 5 MLD STP upgrade and would like to discuss design support.\nThanks.",
        ]);
        $lead->created_at = now();

        return $lead;
    }

    /**
     * @return array<string, string>
     */
    public function placeholderValues(EmailType $type, Lead $lead): array
    {
        $optional = fn (?string $value): string => filled($value) ? (string) $value : 'Not provided';

        return [
            'name' => (string) $lead->name,
            'email' => (string) $lead->email,
            'phone' => $optional($lead->phone),
            'company' => $optional($lead->company),
            'subject' => $optional($lead->subject),
            'message' => (string) $lead->message,
            'form_type' => Str::of((string) $lead->form_type)->replace('_', ' ')->ucfirst()->toString(),
            'submission_date' => ($lead->created_at ?? now())->inDisplayTimezone()->format(self::DATE_FORMAT),
            'company_name' => (string) (Setting::get('site_name') ?: config('app.name')),
            'company_email' => (string) Setting::get('contact_email', ''),
            'company_phone' => (string) Setting::get('phone', ''),
            'company_website' => url('/'),
            'admin_url' => $type === EmailType::AdminNotification
                ? ($lead->exists ? route('admin.leads.show', $lead) : route('admin.leads.index'))
                : '',
        ];
    }

    /**
     * Replaces placeholders with raw values (for subject, names and text).
     *
     * @param  array<string, string>  $values
     */
    public function replace(string $template, array $values, ?callable $format = null): string
    {
        return preg_replace_callback('/\{\{\s*([a-z_]+)\s*\}\}/', function (array $match) use ($values, $format): string {
            if (! array_key_exists($match[1], $values)) {
                return $match[0];
            }

            return $format ? $format($match[1], $values[$match[1]]) : $values[$match[1]];
        }, $template) ?? $template;
    }

    /**
     * @param  array<string, string>  $values
     */
    private function bodyToHtml(string $template, array $values): string
    {
        $html = $this->containsHtml($template)
            ? clean($template, self::PURIFIER)
            : collect(preg_split('/\R{2,}/', trim($template)) ?: [])
                ->map(fn (string $paragraph) => '<p>'.nl2br(e($paragraph), false).'</p>')
                ->implode("\n");

        return $this->replace($html, $values, fn (string $key, string $value): string => $key === 'message' ? nl2br(e($value), false) : e($value));
    }

    /**
     * @param  array<string, string>  $values
     */
    private function plainToHtml(string $template, array $values): string
    {
        return nl2br($this->replace(e(trim($template)), $values, fn (string $key, string $value): string => e($value)), false);
    }

    /**
     * @param  array{0: string, 1: string}|null  $button
     * @param  array<string, string>  $values
     */
    private function plainText(string $heading, string $body, ?array $button, string $company, string $footer, array $values): string
    {
        $toText = function (string $html): string {
            $html = preg_replace(['/\R/u', '#<br\s*/?>#i', '#</(p|h[1-6]|li|blockquote)>#i'], [' ', "\n", "\n\n"], $html) ?? '';
            $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5);
            $text = preg_replace(['/[ \t]+/', '/ ?\n ?/', "/\n{3,}/"], [' ', "\n", "\n\n"], $text) ?? $text;

            return trim($text);
        };

        $sections = [
            $toText($heading),
            $toText($body),
            $button ? $this->replace($button[0], $values).': '.$button[1] : null,
            $toText($company),
            $toText($footer),
        ];

        return implode("\n\n", array_filter($sections, 'filled'));
    }

    private function containsHtml(string $value): bool
    {
        return $value !== strip_tags($value);
    }
}
