{{-- admin/email-settings/_logs.blade.php --}}
<p class="text-xs text-gray-500 mb-4 max-w-3xl">
    <strong>Sent</strong> means the mail server accepted the message. The site cannot see whether it then reached the inbox,
    so check spam folders and your mail provider’s logs if a recipient reports nothing arrived. Failed enquiry emails are retried
    automatically up to 3 times and can be retried manually. The enquiry itself is always kept in Leads.
</p>

@if($stalledCount > 0)
<div class="mb-4 max-w-3xl bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg px-4 py-3 text-sm" role="status">
    <p class="font-medium">
        {{ $stalledCount }} enquiry {{ Str::plural('email', $stalledCount) }} {{ $stalledCount === 1 ? 'has' : 'have' }} been queued for more than
        {{ \App\Services\Mail\QueueHeartbeat::STALLED_AFTER_MINUTES }} minutes without a send attempt.
    </p>
    <p class="text-xs mt-1">
        The queue worker last ran: <strong>{{ $workerLastRunAt?->diffForHumans() ?? 'never' }}</strong>.
        Queued emails are sent by the server’s scheduler, which needs a cron job running
        <code class="bg-yellow-100 px-1 rounded">php artisan schedule:run</code> every minute.
        Ask your hosting administrator to check it — the emails go out as soon as it runs.
    </p>
</div>
@endif

<div x-data="emailLogs()" @keydown.escape.window="cancel()">
    <p x-show="notice" x-cloak x-text="notice" role="status"
       class="mb-4 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 text-sm"></p>

    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="hidden" name="tab" value="logs">
        <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
            <option value="">All statuses</option>
            @foreach(\App\Enums\EmailStatus::cases() as $status)
            <option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
        <select name="type" class="px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
            <option value="">All types</option>
            @foreach(\App\Enums\EmailType::cases() as $type)
            <option value="{{ $type->value }}" @selected(request('type') === $type->value)>{{ $type->label() }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded-lg text-sm">Filter</button>
        <a href="{{ route('admin.email-settings.index', ['tab' => 'logs']) }}" class="px-4 py-2 border border-gray-300 text-sm rounded-lg hover:bg-gray-50">Reset</a>
    </form>

    <div class="bg-white rounded-xl border border-gray-200 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Attempted</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Type</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Enquiry</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Recipients</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Tries</th>
                    <th class="px-4 py-3 text-right font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($logs as $log)
                <tr class="align-top hover:bg-gray-50" data-email-log-row>
                    <td class="px-4 py-3 text-xs text-gray-500 whitespace-nowrap">
                        {{ ($log->last_attempt_at ?? $log->created_at)->inDisplayTimezone()->format('M d, Y H:i T') }}
                        <span class="block text-gray-400">#{{ $log->id }} · {{ $log->transport ?? '—' }}</span>
                    </td>
                    <td class="px-4 py-3 text-xs text-gray-700 whitespace-nowrap">{{ $log->type->label() }}</td>
                    <td class="px-4 py-3 text-xs">
                        @if($log->lead)
                        <a href="{{ route('admin.leads.show', $log->lead) }}" class="text-teal-600 hover:underline">#{{ $log->lead_id }} {{ $log->lead->name }}</a>
                        @elseif($log->type === \App\Enums\EmailType::Test)
                        <span class="text-gray-400">—</span>
                        @else
                        <span class="text-gray-400">Deleted</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-xs text-gray-700 break-all max-w-xs">
                        {{ $log->recipientSummary() ?: '—' }}
                        @if($log->subject)<span class="block text-gray-400 mt-0.5">{{ $log->subject }}</span>@endif
                    </td>
                    <td class="px-4 py-3">
                        @include('admin.email-settings._status')
                        @if($log->error)<p class="text-xs text-red-600 mt-1 max-w-xs break-words">{{ $log->error }}</p>@endif
                    </td>
                    <td class="px-4 py-3 text-xs text-gray-600">{{ $log->attempts }}</td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-3 whitespace-nowrap">
                            @if($log->isRetryable())
                            <form method="POST" action="{{ route('admin.email-settings.logs.retry', $log) }}" onsubmit="return confirm('Send this email again?')">
                                @csrf
                                <button type="submit" class="text-xs text-teal-600 hover:text-navy-800 font-medium py-1">Retry</button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('admin.email-settings.logs.destroy', $log) }}"
                                  @submit.prevent="ask($el, {{ $log->id }}, @js($log->status === \App\Enums\EmailStatus::Queued))">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 text-xs text-red-500 hover:text-red-700 font-medium py-1" aria-label="Delete email log #{{ $log->id }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-4 py-10 text-center text-gray-400">No emails logged yet.</td></tr>
                @endforelse
                <tr x-show="empty" x-cloak>
                    <td colspan="7" class="px-4 py-10 text-center text-gray-400">
                        No emails left on this page. <a href="{{ request()->fullUrl() }}" class="text-teal-600 hover:underline">Reload the log</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $logs->links() }}</div>

    {{-- Delete confirmation --}}
    <div x-show="pending" x-cloak class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-4 bg-black/50" @click.self="cancel()">
        <div role="alertdialog" aria-modal="true" aria-labelledby="delete-email-log-title" aria-describedby="delete-email-log-body"
             class="w-full max-w-md bg-white rounded-xl shadow-xl p-6">
            <h3 id="delete-email-log-title" class="text-base font-semibold text-gray-900">
                Delete email log <span x-text="pending ? '#' + pending.id : ''"></span>?
            </h3>
            <div id="delete-email-log-body" class="text-sm text-gray-600 mt-2">
                <p>Are you sure you want to delete this email log? This action cannot be undone.</p>
                <p class="mt-2 text-xs text-gray-500">
                    The enquiry stays in Leads.
                    <span x-show="pending?.queued">This email has not been sent yet — deleting the log also cancels it.</span>
                </p>
            </div>
            <p x-show="error" x-text="error" class="text-sm text-red-600 mt-3" role="alert"></p>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-2 mt-6">
                <button type="button" x-ref="cancel" @click="cancel()" :disabled="busy"
                        class="px-4 py-2 border border-gray-300 text-sm rounded-lg hover:bg-gray-50 disabled:opacity-50">Cancel</button>
                <button type="button" @click="destroy()" :disabled="busy"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg disabled:opacity-50"
                        x-text="busy ? 'Deleting…' : 'Delete'"></button>
            </div>
        </div>
    </div>
</div>

<script>
    function emailLogs() {
        return {
            pending: null,
            busy: false,
            error: '',
            notice: '',
            empty: false,

            ask(form, id, queued) {
                this.pending = { form, id, queued };
                this.error = '';
                this.$nextTick(() => this.$refs.cancel.focus());
            },

            cancel() {
                if (! this.busy) {
                    this.pending = null;
                }
            },

            async destroy() {
                const form = this.pending.form;
                this.busy = true;
                this.error = '';

                try {
                    // The form carries the CSRF token and _method=DELETE.
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                        body: new FormData(form),
                    });
                    const data = await response.json().catch(() => ({}));

                    if (! response.ok) {
                        this.error = response.status === 419
                            ? 'Your session has expired. Reload the page and try again.'
                            : (data.message || 'The email log could not be deleted. Please try again.');

                        return;
                    }

                    form.closest('tr').remove();
                    this.empty = ! this.$root.querySelector('[data-email-log-row]');
                    this.updateFailedBadge(data.failedCount);
                    this.notice = data.message;
                    this.pending = null;
                } catch (e) {
                    this.error = 'The server could not be reached. Check your connection and try again.';
                } finally {
                    this.busy = false;
                }
            },

            updateFailedBadge(count) {
                const badge = document.getElementById('email-failed-badge');

                if (badge && typeof count === 'number') {
                    badge.textContent = count;
                    badge.hidden = count === 0;
                }
            },
        };
    }
</script>
