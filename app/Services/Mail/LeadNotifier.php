<?php

namespace App\Services\Mail;

use App\Enums\EmailStatus;
use App\Enums\EmailType;
use App\Jobs\SendLeadEmail;
use App\Models\EmailLog;
use App\Models\Lead;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Queues the admin notification and the visitor acknowledgement for a
 * stored enquiry. Never throws: a mail problem must not lose the enquiry or
 * surface an error to the visitor — it is recorded on the email log instead.
 */
class LeadNotifier
{
    public function __construct(private EmailSettings $settings) {}

    public function notify(Lead $lead): void
    {
        $recipients = $this->settings->recipients();

        $this->queue($lead, EmailType::AdminNotification, $recipients['to'], $recipients['cc'], $recipients['bcc'],
            $recipients['to'] === [] ? 'No notification recipients are configured in Email Settings.' : null);

        $this->queue($lead, EmailType::CustomerAcknowledgement, [$lead->email]);
    }

    /**
     * Re-sends a failed email to the recipients originally recorded.
     */
    public function retry(EmailLog $log): void
    {
        $log->update(['status' => EmailStatus::Queued, 'error' => null]);

        $this->dispatch($log);
    }

    /**
     * @param  array<int, string>  $to
     * @param  array<int, string>  $cc
     * @param  array<int, string>  $bcc
     */
    private function queue(Lead $lead, EmailType $type, array $to, array $cc = [], array $bcc = [], ?string $skipReason = null): void
    {
        if (! $this->settings->isEnabled($type)) {
            return;
        }

        try {
            $log = EmailLog::create([
                'lead_id' => $lead->id,
                'type' => $type,
                'recipients' => $to,
                'cc' => $cc ?: null,
                'bcc' => $bcc ?: null,
                'status' => $skipReason ? EmailStatus::Skipped : EmailStatus::Queued,
                'error' => $skipReason,
            ]);
        } catch (Throwable $exception) {
            Log::error("Could not log {$type->value} email for lead #{$lead->id}: ".class_basename($exception));

            return;
        }

        if (! $skipReason) {
            $this->dispatch($log);
        }
    }

    private function dispatch(EmailLog $log): void
    {
        try {
            SendLeadEmail::dispatch($log->id);
        } catch (EmailDeliveryFailed) {
            // Synchronous queue: the job already recorded the failure on the log.
        } catch (Throwable $exception) {
            Log::error("Email #{$log->id} could not be queued: ".class_basename($exception));

            // A synchronous job that failed has already recorded its own reason.
            if ($log->fresh()?->status === EmailStatus::Failed) {
                return;
            }

            $log->update([
                'status' => EmailStatus::Failed,
                'error' => 'The email could not be queued ('.class_basename($exception).').',
            ]);
        }
    }
}
