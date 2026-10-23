<?php

namespace App\Services\Mail;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RuntimeException;
use Symfony\Component\Mailer\Transport\Smtp\SmtpTransport;
use Throwable;

/**
 * Builds the outgoing mailer from the admin-managed SMTP settings.
 *
 * The SMTP mailer is re-registered and purged on every call, so a settings
 * change applies to the very next email — including inside a long-running
 * queue worker — without a restart or `config:cache` rebuild. When SMTP is
 * disabled, mail falls back to the server's default mailer (MAIL_MAILER).
 */
class DynamicMailer
{
    public const MAILER = 'admin_smtp';

    public function __construct(private EmailSettings $settings) {}

    public function usesSmtp(): bool
    {
        $smtp = $this->settings->smtp();

        return $smtp['enabled'] && filled($smtp['host']) && $smtp['port'] > 0;
    }

    public function mailer(): Mailer
    {
        if (! $this->usesSmtp()) {
            return Mail::mailer();
        }

        config(['mail.mailers.'.self::MAILER => $this->transportConfig()]);
        Mail::purge(self::MAILER);

        return Mail::mailer(self::MAILER);
    }

    /**
     * Name of the transport that will carry the next email, for the email log.
     */
    public function transportName(): string
    {
        return $this->usesSmtp() ? 'smtp' : (string) config('mail.default');
    }

    /**
     * @return array{address: string, name: string}
     */
    public function from(?string $nameOverride = null): array
    {
        $smtp = $this->settings->smtp();

        return [
            'address' => $smtp['from_address'] ?: (string) config('mail.from.address'),
            'name' => self::singleLine($nameOverride ?: ($smtp['from_name'] ?: (string) config('mail.from.name'))),
        ];
    }

    /**
     * Opens and authenticates an SMTP session without sending anything.
     *
     * @throws RuntimeException with a credential-free message
     */
    public function testConnection(): void
    {
        if (! $this->usesSmtp()) {
            throw new RuntimeException('SMTP is disabled or incomplete. Enable it, fill in the host and port, and save before testing.');
        }

        $transport = Mail::build($this->transportConfig())->getSymfonyTransport();

        try {
            if ($transport instanceof SmtpTransport) {
                $transport->start();
                $transport->stop();
            }
        } catch (Throwable $exception) {
            throw new RuntimeException($this->sanitize($exception));
        }
    }

    /**
     * An error message safe to store, log and show to administrators:
     * credentials are redacted and the text is flattened and truncated.
     */
    public function sanitize(Throwable|string $error): string
    {
        $message = $error instanceof Throwable ? $error->getMessage() : $error;
        $smtp = $this->settings->smtp();

        foreach (array_filter([$smtp['password'], $smtp['username']]) as $secret) {
            $message = str_replace($secret, '[redacted]', $message);
            $message = str_replace(base64_encode($secret), '[redacted]', $message);
        }

        return Str::limit(self::singleLine($message), 500);
    }

    public static function singleLine(string $value): string
    {
        return trim(preg_replace('/[\x00-\x1F\x7F]+/u', ' ', $value) ?? '');
    }

    /**
     * @return array<string, mixed>
     */
    private function transportConfig(): array
    {
        $smtp = $this->settings->smtp();

        return [
            'transport' => 'smtp',
            'scheme' => $smtp['encryption'] === 'ssl' ? 'smtps' : 'smtp',
            'host' => $smtp['host'],
            'port' => $smtp['port'],
            'username' => $smtp['username'] ?: null,
            'password' => $smtp['password'] ?: null,
            'timeout' => $smtp['timeout'] ?: 30,
            'require_tls' => $smtp['encryption'] === 'tls',
            'auto_tls' => $smtp['encryption'] !== 'none',
            'local_domain' => parse_url((string) config('app.url'), PHP_URL_HOST) ?: null,
            'from' => $this->from(),
        ];
    }
}
