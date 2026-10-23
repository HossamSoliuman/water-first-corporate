<?php

namespace App\Jobs;

use App\Enums\EmailStatus;
use App\Enums\EmailType;
use App\Mail\LeadConfirmation;
use App\Mail\NewLeadNotification;
use App\Models\EmailLog;
use App\Services\Mail\EmailDelivery;
use App\Services\Mail\EmailDeliveryFailed;
use App\Services\Mail\EmailTemplateRenderer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\MaxAttemptsExceededException;
use Illuminate\Queue\TimeoutExceededException;
use Throwable;

/**
 * Sends one logged lead email.
 *
 * Recipients were fixed on the log row when the enquiry arrived; the
 * template and SMTP transport are read from the current settings when the
 * job runs, so fixing a bad SMTP password lets pending retries succeed.
 * A row already marked sent is never sent again, and a row an administrator
 * deleted cancels the email: the job finds no log and does nothing.
 */
class SendLeadEmail implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    public int $timeout = 120;

    public function __construct(public int $emailLogId) {}

    /**
     * @return array<int, int>
     */
    public function backoff(): array
    {
        return [60, 300];
    }

    public function handle(EmailTemplateRenderer $renderer, EmailDelivery $delivery): void
    {
        $log = EmailLog::with('lead')->find($this->emailLogId);

        if (! $log || in_array($log->status, [EmailStatus::Sent, EmailStatus::Skipped], true)) {
            return;
        }

        if (! $log->lead) {
            $log->update(['status' => EmailStatus::Failed, 'error' => 'The enquiry was deleted before this email was sent.']);

            return;
        }

        $email = $renderer->render($log->type, $log->lead);

        $mailable = $log->type === EmailType::AdminNotification
            ? new NewLeadNotification($email)
            : new LeadConfirmation($email);

        try {
            $delivery->send($log, $mailable);
        } catch (EmailDeliveryFailed $exception) {
            if ($this->attempts() < $this->tries) {
                $log->update(['status' => EmailStatus::Queued]);
            }

            throw $exception;
        }
    }

    public function failed(?Throwable $exception): void
    {
        EmailLog::whereKey($this->emailLogId)
            ->where('status', '!=', EmailStatus::Sent->value)
            ->update([
                'status' => EmailStatus::Failed->value,
                'error' => $this->failureReason($exception),
            ]);
    }

    /**
     * A reason an administrator can act on. Transport errors are already
     * sanitised; anything else is named by class only, never by its message.
     */
    private function failureReason(?Throwable $exception): string
    {
        return match (true) {
            $exception instanceof EmailDeliveryFailed => $exception->getMessage(),
            $exception instanceof TimeoutExceededException => "The mail server did not finish within {$this->timeout} seconds. Check the SMTP host and port, then retry.",
            $exception instanceof MaxAttemptsExceededException => 'The queue worker stopped before this email finished sending, too many times. Check the server cron and PHP limits, then retry.',
            default => 'The email job failed ('.class_basename($exception ?? 'Unknown error').'). See the application log.',
        };
    }
}
