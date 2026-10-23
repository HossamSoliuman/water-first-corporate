<?php

namespace App\Mail;

use App\Jobs\SendLeadEmail;
use App\Services\Mail\RenderedEmail;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

/**
 * A mailable whose subject and content were produced by the template
 * renderer. Sending (and queueing) is handled by {@see SendLeadEmail},
 * so these mailables are never queued themselves.
 */
abstract class RenderedMailable extends Mailable
{
    public function __construct(public RenderedEmail $email) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email->fromAddress, $this->email->fromName),
            replyTo: $this->email->replyToAddress
                ? [new Address($this->email->replyToAddress, $this->email->replyToName)]
                : [],
            subject: $this->email->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.templated',
            text: 'emails.templated-text',
        );
    }
}
