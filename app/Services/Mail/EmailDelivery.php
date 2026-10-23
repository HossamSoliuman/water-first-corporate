<?php

namespace App\Services\Mail;

use App\Enums\EmailStatus;
use App\Mail\RenderedMailable;
use App\Models\EmailLog;
use Throwable;

/**
 * Hands one logged email to the current transport and records the outcome.
 */
class EmailDelivery
{
    public function __construct(private DynamicMailer $mailer) {}

    /**
     * @throws EmailDeliveryFailed
     */
    public function send(EmailLog $log, RenderedMailable $mailable): void
    {
        $log->update([
            'status' => EmailStatus::Sending,
            'subject' => $mailable->email->subject,
            'attempts' => $log->attempts + 1,
            'last_attempt_at' => now(),
            'transport' => $this->mailer->transportName(),
        ]);

        try {
            $sent = $this->mailer->mailer()
                ->to($log->recipients)
                ->cc($log->cc ?? [])
                ->bcc($log->bcc ?? [])
                ->send($mailable);
        } catch (Throwable $exception) {
            $error = $this->mailer->sanitize($exception);
            $log->update(['status' => EmailStatus::Failed, 'error' => $error]);

            throw new EmailDeliveryFailed($error);
        }

        $log->update([
            'status' => EmailStatus::Sent,
            'sent_at' => now(),
            'error' => null,
            'message_id' => $sent?->getMessageId(),
        ]);
    }
}
