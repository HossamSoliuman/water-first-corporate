<?php

namespace App\Models;

use App\Enums\EmailStatus;
use App\Enums\EmailType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmailLog extends Model
{
    protected $fillable = [
        'lead_id', 'type', 'recipients', 'cc', 'bcc', 'subject', 'status',
        'attempts', 'error', 'transport', 'message_id', 'last_attempt_at', 'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'type' => EmailType::class,
            'status' => EmailStatus::class,
            'recipients' => 'array',
            'cc' => 'array',
            'bcc' => 'array',
            'attempts' => 'integer',
            'last_attempt_at' => 'datetime',
            'sent_at' => 'datetime',
        ];
    }

    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }

    public function isRetryable(): bool
    {
        return $this->status === EmailStatus::Failed && $this->type !== EmailType::Test;
    }

    /**
     * A worker is handing this email to the mail server right now. A row
     * stuck in "sending" for longer belongs to a worker that died mid-send.
     */
    public function isBeingSent(): bool
    {
        return $this->status === EmailStatus::Sending
            && $this->last_attempt_at?->gt(now()->subMinutes(10));
    }

    /**
     * Every address the message goes to, for display.
     */
    public function recipientSummary(): string
    {
        $parts = [implode(', ', $this->recipients ?? [])];

        if ($this->cc) {
            $parts[] = 'CC: '.implode(', ', $this->cc);
        }

        if ($this->bcc) {
            $parts[] = 'BCC: '.implode(', ', $this->bcc);
        }

        return implode(' · ', $parts);
    }
}
