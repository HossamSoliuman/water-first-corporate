<?php

namespace App\Services\Mail;

use App\Enums\EmailStatus;
use App\Enums\EmailType;
use App\Models\EmailLog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * Records when the scheduler last started the queue worker, so the admin
 * panel can tell a delivery problem apart from a worker that never runs.
 */
class QueueHeartbeat
{
    private const KEY = 'mail:queue-worker:last-run';

    /**
     * An enquiry email still queued after this many minutes means nothing is
     * processing the queue: the scheduler would have picked it up within one.
     */
    public const STALLED_AFTER_MINUTES = 5;

    public function record(): void
    {
        Cache::forever(self::KEY, now()->getTimestamp());
    }

    public function lastRunAt(): ?Carbon
    {
        $timestamp = Cache::get(self::KEY);

        return $timestamp ? Carbon::createFromTimestamp($timestamp) : null;
    }

    /**
     * Enquiry emails that have waited in the queue without a single attempt.
     */
    public function stalledCount(): int
    {
        return EmailLog::where('status', EmailStatus::Queued)
            ->where('type', '!=', EmailType::Test)
            ->where('attempts', 0)
            ->where('created_at', '<', now()->subMinutes(self::STALLED_AFTER_MINUTES))
            ->count();
    }
}
