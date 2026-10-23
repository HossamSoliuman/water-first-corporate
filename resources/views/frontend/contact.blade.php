@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Get in touch"
        title="Let's build"
        title-accent="something together"
        :breadcrumbs="[['name' => 'Contact Us']]"
    />

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-14 lg:grid-cols-12">
                <div class="reveal-left lg:col-span-4">
                    <h2 class="text-2xl font-semibold text-ink-900">Contact information</h2>

                    <dl class="mt-8 border-t border-line">
                        <div class="border-b border-line py-5">
                            <dt class="font-mono text-[11px] uppercase tracking-[.14em] text-ink-500">Corporate office</dt>
                            <dd class="mt-2 text-base leading-7 text-ink-900">41021, Sobha Dream Acres, Bangalore, Karnataka, India</dd>
                        </div>
                        <div class="border-b border-line py-5">
                            <dt class="font-mono text-[11px] uppercase tracking-[.14em] text-ink-500">Phone</dt>
                            <dd class="mt-2 space-y-1 font-mono text-[15px] text-ink-900">
                                <a href="tel:+919886208825" class="block hover:text-primary-600"><span class="text-ink-400">IN</span> +91 98862 08825</a>
                                <a href="tel:+12143421735" class="block hover:text-primary-600"><span class="text-ink-400">US</span> +1 214 342 1735</a>
                            </dd>
                        </div>
                        @if ($settings->get('contact_email'))
                            <div class="border-b border-line py-5">
                                <dt class="font-mono text-[11px] uppercase tracking-[.14em] text-ink-500">Email</dt>
                                <dd class="mt-2">
                                    <a href="mailto:{{ $settings->get('contact_email') }}" class="break-all text-base text-ink-900 hover:text-primary-600">{{ $settings->get('contact_email') }}</a>
                                </dd>
                            </div>
                        @endif
                    </dl>

                    <p class="mt-8 border-l-2 border-accent-500 pl-5 font-heading text-lg font-semibold leading-snug text-ink-900">
                        Time-bound delivery, cost-effective design and close collaboration on every engagement.
                    </p>
                </div>

                <div class="reveal-right border-t-2 border-primary-600 pt-8 lg:col-span-8">
                    <h2 class="mb-8 text-2xl font-semibold text-ink-900">Send a message</h2>
                    @include('frontend.partials.contact-form')
                </div>
            </div>
        </div>
    </section>
@endsection
