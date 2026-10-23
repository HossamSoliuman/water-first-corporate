<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmailStatus;
use App\Enums\EmailType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SendTestEmailRequest;
use App\Http\Requests\Admin\UpdateNotificationRecipientsRequest;
use App\Http\Requests\Admin\UpdateSmtpSettingsRequest;
use App\Mail\TestEmail;
use App\Models\EmailLog;
use App\Services\Mail\DynamicMailer;
use App\Services\Mail\EmailDelivery;
use App\Services\Mail\EmailDeliveryFailed;
use App\Services\Mail\EmailSettings;
use App\Services\Mail\EmailTemplateRenderer;
use App\Services\Mail\QueueHeartbeat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;

class EmailSettingController extends Controller
{
    public const TABS = ['smtp', 'recipients', 'admin-template', 'auto-reply', 'logs'];

    public function __construct(
        private EmailSettings $settings,
        private DynamicMailer $mailer,
    ) {}

    public function index(Request $request, QueueHeartbeat $heartbeat): View
    {
        $request->validate([
            'status' => ['nullable', Rule::enum(EmailStatus::class)],
            'type' => ['nullable', Rule::enum(EmailType::class)],
        ]);

        $smtp = $this->settings->smtp();
        unset($smtp['password']);

        $logs = EmailLog::with('lead:id,name')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('type'), fn ($query) => $query->where('type', $request->type))
            ->latest('id')
            ->paginate(25, pageName: 'logs_page')
            ->withQueryString();

        $tab = in_array($request->query('tab'), self::TABS, true)
            ? $request->query('tab')
            : ($request->hasAny(['status', 'type', 'logs_page']) ? 'logs' : 'smtp');

        return view('admin.email-settings.index', [
            'tab' => session('tab', $tab),
            'smtp' => $smtp,
            'hasPassword' => $this->settings->hasPassword(),
            'usesSmtp' => $this->mailer->usesSmtp(),
            'fallbackMailer' => config('mail.default'),
            'lastTestedAt' => $this->settings->get('mail_smtp_last_tested_at'),
            'allowedPorts' => config('mail.dynamic_smtp.allowed_ports'),
            'adminEnabled' => $this->settings->bool('mail_admin_enabled'),
            'ackEnabled' => $this->settings->bool('mail_ack_enabled'),
            'recipients' => $this->settings->recipients(),
            'adminTemplate' => $this->settings->template(EmailType::AdminNotification),
            'ackTemplate' => $this->settings->template(EmailType::CustomerAcknowledgement),
            'placeholders' => EmailTemplateRenderer::PLACEHOLDERS,
            'adminPlaceholders' => EmailTemplateRenderer::ADMIN_PLACEHOLDERS,
            'logs' => $logs,
            'failedCount' => EmailLog::where('status', EmailStatus::Failed)->count(),
            'stalledCount' => $heartbeat->stalledCount(),
            'workerLastRunAt' => $heartbeat->lastRunAt(),
        ]);
    }

    public function updateSmtp(UpdateSmtpSettingsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $before = $this->settings->smtp();

        $values = [
            'mail_smtp_enabled' => $data['smtp_enabled'],
            'mail_smtp_host' => $data['host'] ?? null,
            'mail_smtp_port' => $data['port'] ?? null,
            'mail_smtp_encryption' => $data['encryption'],
            'mail_smtp_username' => $data['username'] ?? null,
            'mail_smtp_timeout' => $data['timeout'] ?? 30,
            'mail_from_address' => $data['from_address'] ?? null,
            'mail_from_name' => $data['from_name'] ?? null,
        ];

        if ($data['remove_password']) {
            $values['mail_smtp_password'] = null;
        } elseif (filled($data['password'] ?? null)) {
            $values['mail_smtp_password'] = $data['password'];
        }

        $this->settings->put($values);

        $after = $this->settings->smtp();
        $connectionChanged = collect(['host', 'port', 'encryption', 'username', 'password'])
            ->contains(fn (string $field) => $before[$field] != $after[$field]);

        if ($connectionChanged) {
            $this->settings->put(['mail_smtp_last_tested_at' => null]);
        }

        return $this->back('smtp', 'SMTP settings saved.'.($after['enabled'] ? ' Use “Test SMTP connection” to confirm they work.' : ''));
    }

    public function testConnection(): RedirectResponse
    {
        try {
            $this->mailer->testConnection();
        } catch (RuntimeException $exception) {
            return $this->back('smtp', error: 'SMTP connection failed: '.$exception->getMessage());
        }

        $this->settings->put(['mail_smtp_last_tested_at' => now()->toIso8601String()]);

        return $this->back('smtp', 'Connected and authenticated with the SMTP server successfully.');
    }

    public function sendTestEmail(SendTestEmailRequest $request, EmailTemplateRenderer $renderer, EmailDelivery $delivery): RedirectResponse
    {
        $recipient = $request->validated('test_recipient');

        $log = EmailLog::create([
            'type' => EmailType::Test,
            'recipients' => [$recipient],
            'status' => EmailStatus::Queued,
        ]);

        try {
            $delivery->send($log, new TestEmail($renderer->test($this->mailer->transportName())));
        } catch (EmailDeliveryFailed $exception) {
            return $this->back('smtp', error: 'Test email failed: '.$exception->getMessage());
        }

        if ($this->mailer->usesSmtp()) {
            $this->settings->put(['mail_smtp_last_tested_at' => now()->toIso8601String()]);
        }

        return $this->back('smtp', "Test email handed to the {$this->mailer->transportName()} mailer for {$recipient}. Check that inbox (and its spam folder) to confirm delivery.");
    }

    public function updateRecipients(UpdateNotificationRecipientsRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->settings->put([
            'mail_admin_enabled' => $data['admin_enabled'],
            'mail_admin_recipients' => $data['recipients'],
            'mail_admin_cc' => $data['cc'],
            'mail_admin_bcc' => $data['bcc'],
        ]);

        return $this->back('recipients', $data['admin_enabled']
            ? 'Notification recipients saved. New enquiries will be sent to '.count($data['recipients']).' recipient(s).'
            : 'Saved. Admin notification emails are now turned off.');
    }

    private function back(string $tab, ?string $success = null, ?string $error = null): RedirectResponse
    {
        return redirect()
            ->route('admin.email-settings.index', ['tab' => $tab])
            ->with(array_filter(['success' => $success, 'error' => $error]));
    }
}
