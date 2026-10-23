{{-- admin/email-settings/_status.blade.php — expects $log (EmailLog) --}}
@php
    $retrying = $log->status === \App\Enums\EmailStatus::Queued && $log->error;
    $color = $log->status->color();
@endphp
<span class="inline-block text-xs px-2 py-0.5 rounded-full font-medium whitespace-nowrap bg-{{ $color }}-100 text-{{ $color }}-700">
    {{ $retrying ? 'Retry pending' : $log->status->label() }}
</span>
