@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Get in Touch"
        title="Let's Build"
        title-accent="Something Together"
        subtitle="Tell us about your project and our engineering team will be in touch."
        :breadcrumbs="[['name' => 'Contact Us']]"
    />

    <section class="bg-surface py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-3">

                <div class="reveal-left space-y-6">
                    <div>
                        <h2 class="mb-6 font-heading text-2xl text-ink-900">Contact Information</h2>
                        <div class="space-y-4">
                            @foreach (array_filter([
                                ['map-pin', 'Registered Office', $settings->get('address_india') ?: $settings->get('address')],
                                ['phone', 'Phone', $settings->get('phone')],
                                ['envelope', 'Email', $settings->get('contact_email')],
                            ], fn ($row) => (bool) $row[2]) as [$icon, $label, $value])
                                <div class="flex gap-4">
                                    <div class="icon-tile flex h-10 w-10 shrink-0 items-center justify-center">
                                        <x-icon name="{{ $icon }}" class="h-5 w-5" />
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wide text-ink-400">{{ $label }}</p>
                                        @if ($icon === 'phone')
                                            <a href="tel:{{ $value }}" class="mt-0.5 block text-sm text-ink-800 transition-colors hover:text-accent-600">{{ $value }}</a>
                                        @elseif ($icon === 'envelope')
                                            <a href="mailto:{{ $value }}" class="mt-0.5 block break-all text-sm text-ink-800 transition-colors hover:text-accent-600">{{ $value }}</a>
                                        @else
                                            <p class="mt-0.5 text-sm text-ink-800">{{ $value }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="wf-panel p-6">
                        <p class="mb-2 font-display text-lg font-semibold text-white">
                            {{ $settings->get('site_tagline', 'Engineering Water, Sustainably') }}
                        </p>
                        <p class="text-sm text-primary-200">
                            Time-bound delivery, cost-effective design and close collaboration on every engagement.
                        </p>
                    </div>
                </div>

                <div class="reveal-right rounded-2xl border border-ink-100 bg-white p-8 shadow-sm md:p-10 lg:col-span-2">
                    <h2 class="mb-8 font-heading text-2xl text-ink-900">Send a Message</h2>
                    @include('frontend.partials.contact-form')
                </div>
            </div>
        </div>
    </section>
@endsection
