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
                                ['map-pin', 'Corporate office', '41021, Sobha Dream Acres, Bangalore, Karnataka, India'],
                                ['phone', 'Phone', $settings->get('phone')],
                                ['envelope', 'Email', $settings->get('contact_email')],
                            ], fn ($row) => (bool) $row[2]) as [$icon, $label, $value])
                                <div class="flex gap-4">
                                    <div class="icon-tile flex h-10 w-10 shrink-0 items-center justify-center">
                                        <x-icon name="{{ $icon }}" class="h-5 w-5" />
                                    </div>
                                    <div>
                                        
                                        <p class="text-xs font-semibold uppercase tracking-wide text-ink-400">
    {{ $label }}
</p>

@if ($icon === 'phone')
    <div class="mt-0.5 text-sm text-ink-800">
        <a href="tel:+919886208825"
           class="block transition-colors hover:text-accent-600">
            India - +91 98862 08825
        </a>

        <a href="tel:+12143421735"
           class="block transition-colors hover:text-accent-600">
            USA - +1 2143421735
        </a>
    </div>
@elseif ($icon === 'envelope')
    <a href="mailto:{{ $value }}"
       class="mt-0.5 block break-all text-sm text-ink-800 transition-colors hover:text-accent-600">
        {{ $value }}
    </a>
@else
    <p class="mt-0.5 text-sm text-ink-800">
        {{ $value }}
    </p>
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
