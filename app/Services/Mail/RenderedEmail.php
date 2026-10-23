<?php

namespace App\Services\Mail;

/**
 * A fully rendered email. Every HTML fragment is already sanitised and has
 * visitor values escaped, so views may output them unescaped.
 */
final class RenderedEmail
{
    public function __construct(
        public readonly string $subject,
        public readonly string $headingHtml,
        public readonly string $bodyHtml,
        public readonly string $footerHtml,
        public readonly string $companyDetailsHtml,
        public readonly ?string $buttonText,
        public readonly ?string $buttonUrl,
        public readonly string $text,
        public readonly string $fromAddress,
        public readonly string $fromName,
        public readonly ?string $replyToAddress = null,
        public readonly ?string $replyToName = null,
    ) {}

    public function html(): string
    {
        return view('emails.templated', ['email' => $this])->render();
    }
}
