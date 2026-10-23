{{-- admin/email-settings/index.blade.php --}}
@extends('layouts.admin')
@section('title', 'Email Settings')
@section('content')

@php
    $input = 'w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500';
    $label = 'block text-sm font-medium text-gray-700 mb-1.5';
    $hint = 'text-xs text-gray-500 mt-1';
    $tabs = [
        'smtp' => 'SMTP Settings',
        'recipients' => 'Notification Recipients',
        'admin-template' => 'Admin Notification Template',
        'auto-reply' => 'Customer Auto-Reply Template',
        'logs' => 'Email Logs',
    ];
@endphp

<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div>
        <h2 class="text-xl font-heading font-bold text-gray-900">Email Settings</h2>
        <p class="text-sm text-gray-500 mt-0.5">Outgoing mail server, contact form notifications and the visitor auto-reply.</p>
    </div>
    <div class="flex flex-wrap gap-2 text-xs">
        <span class="px-2.5 py-1 rounded-full font-medium {{ $usesSmtp ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">SMTP {{ $usesSmtp ? 'enabled' : 'disabled' }}</span>
        <span class="px-2.5 py-1 rounded-full font-medium {{ $adminEnabled ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">Admin notifications {{ $adminEnabled ? 'on' : 'off' }}</span>
        <span class="px-2.5 py-1 rounded-full font-medium {{ $ackEnabled ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">Auto-reply {{ $ackEnabled ? 'on' : 'off' }}</span>
    </div>
</div>

<div x-data="{ tab: @js($tab), go(t) { this.tab = t; const u = new URL(location.href); u.searchParams.set('tab', t); history.replaceState(null, '', u); } }">
    <div class="flex flex-wrap gap-1 mb-6 bg-gray-100 p-1 rounded-xl w-fit max-w-full">
        @foreach($tabs as $key => $name)
        <button type="button" @click="go('{{ $key }}')"
                :class="tab==='{{ $key }}' ? 'bg-white shadow text-gray-900' : 'text-gray-500 hover:text-gray-700'"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-all">
            {{ $name }}
            @if($key === 'logs' && $failedCount > 0)
            <span id="email-failed-badge" class="ml-1 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">{{ $failedCount }}</span>
            @endif
        </button>
        @endforeach
    </div>

    <div x-show="tab==='smtp'" @if($tab !== 'smtp') x-cloak @endif>
        @include('admin.email-settings._smtp')
    </div>
    <div x-show="tab==='recipients'" @if($tab !== 'recipients') x-cloak @endif>
        @include('admin.email-settings._recipients')
    </div>
    <div x-show="tab==='admin-template'" @if($tab !== 'admin-template') x-cloak @endif>
        @include('admin.email-settings._template', ['type' => \App\Enums\EmailType::AdminNotification, 'template' => $adminTemplate, 'available' => $placeholders + $adminPlaceholders])
    </div>
    <div x-show="tab==='auto-reply'" @if($tab !== 'auto-reply') x-cloak @endif>
        @include('admin.email-settings._template', ['type' => \App\Enums\EmailType::CustomerAcknowledgement, 'template' => $ackTemplate, 'available' => $placeholders])
    </div>
    <div x-show="tab==='logs'" @if($tab !== 'logs') x-cloak @endif>
        @include('admin.email-settings._logs')
    </div>
</div>

@endsection
