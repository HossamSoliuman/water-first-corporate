<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmailStatus;
use App\Enums\EmailType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateEmailTemplateRequest;
use App\Mail\LeadConfirmation;
use App\Mail\NewLeadNotification;
use App\Models\EmailLog;
use App\Services\Mail\EmailDelivery;
use App\Services\Mail\EmailDeliveryFailed;
use App\Services\Mail\EmailSettings;
use App\Services\Mail\EmailTemplateRenderer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class EmailTemplateController extends Controller
{
    public function __construct(
        private EmailSettings $settings,
        private EmailTemplateRenderer $renderer,
    ) {}

    public function update(UpdateEmailTemplateRequest $request, EmailType $type): RedirectResponse
    {
        $template = $request->template();
        $template['body'] = $this->renderer->sanitizeBody($template['body']);

        $prefix = EmailSettings::templatePrefix($type);
        $values = collect($template)->mapWithKeys(fn (string $value, string $field) => [$prefix.$field => $value])->all();

        if ($type === EmailType::CustomerAcknowledgement) {
            $values['mail_ack_enabled'] = $request->validated('enabled');
        }

        $this->settings->put($values);

        $message = $type === EmailType::CustomerAcknowledgement && ! $request->validated('enabled')
            ? 'Template saved. The automatic reply to visitors is turned off.'
            : 'Template saved. It applies to the next enquiry.';

        return redirect()
            ->route('admin.email-settings.index', ['tab' => $this->tab($type)])
            ->with('success', $message);
    }

    /**
     * Renders the submitted (unsaved) template with sample data. The response
     * is sandboxed so nothing in it can script the admin panel.
     */
    public function preview(UpdateEmailTemplateRequest $request, EmailType $type): Response
    {
        $email = $this->renderer->render($type, $this->renderer->sampleLead(), $request->template());

        return response($email->html())->withHeaders([
            'Content-Security-Policy' => "sandbox; default-src 'none'; img-src https: data:; style-src 'unsafe-inline'",
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }

    /**
     * Sends the submitted (unsaved) template, filled with sample data, to a test address.
     */
    public function sendTest(UpdateEmailTemplateRequest $request, EmailType $type, EmailDelivery $delivery): RedirectResponse
    {
        $recipient = $request->validated('test_recipient');
        $redirect = redirect()->route('admin.email-settings.index', ['tab' => $this->tab($type)])->withInput();

        if (blank($recipient)) {
            return $redirect->withErrors(['test_recipient' => 'Enter an address to send the test template to.']);
        }

        $email = $this->renderer->render($type, $this->renderer->sampleLead($recipient), $request->template());

        $log = EmailLog::create([
            'type' => EmailType::Test,
            'recipients' => [$recipient],
            'status' => EmailStatus::Queued,
        ]);

        try {
            $delivery->send($log, $type === EmailType::AdminNotification ? new NewLeadNotification($email) : new LeadConfirmation($email));
        } catch (EmailDeliveryFailed $exception) {
            return $redirect->with('error', 'Test template failed: '.$exception->getMessage());
        }

        return $redirect->with('success', "Test “{$type->label()}” sent to {$recipient} using sample data. Unsaved changes have not been saved.");
    }

    private function tab(EmailType $type): string
    {
        return $type === EmailType::AdminNotification ? 'admin-template' : 'auto-reply';
    }
}
