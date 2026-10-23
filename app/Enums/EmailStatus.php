<?php

namespace App\Enums;

/**
 * "Sent" means the mail server accepted the message. The application has no
 * delivery receipts, so it never claims an email was delivered to the inbox.
 */
enum EmailStatus: string
{
    case Queued = 'queued';
    case Sending = 'sending';
    case Sent = 'sent';
    case Failed = 'failed';
    case Skipped = 'skipped';

    public function label(): string
    {
        return match ($this) {
            self::Queued => 'Queued',
            self::Sending => 'Sending',
            self::Sent => 'Sent (accepted by mail server)',
            self::Failed => 'Failed',
            self::Skipped => 'Skipped',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Queued, self::Sending => 'yellow',
            self::Sent => 'green',
            self::Failed => 'red',
            self::Skipped => 'gray',
        };
    }
}
