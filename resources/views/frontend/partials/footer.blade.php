@php
    $footerLogo = $settings->get('logo_url') ?: 'images/waterfirst-logo.svg';
    $footerSocials = collect(['linkedin', 'twitter', 'facebook', 'instagram'])
        ->filter(fn ($network) => (bool) $settings->get("social_{$network}"));
@endphp

<footer class="relative overflow-hidden border-t border-ink-100 bg-surface wf-texture">
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-12 py-20 md:grid-cols-2 lg:grid-cols-4">

            <div>
                <img src="{{ asset($footerLogo) }}" alt="{{ $settings->get('site_name', 'WaterFirst') }}" class="h-12 w-auto">
                <p class="mt-5 font-display text-lg font-semibold leading-snug text-ink-800">
                    {{ $settings->get('site_tagline', 'Engineering Water, Sustainably') }}
                </p>
                <p class="mt-3 max-w-xs text-sm leading-relaxed text-ink-500">
                    Multi-disciplinary engineering and infrastructure consultancy delivering technically robust, compliant solutions across the full project lifecycle.
                </p>

                @if ($footerSocials->count())
                    <div class="mt-6 flex gap-3">
                        @foreach ($footerSocials as $network)
                            <a href="{{ $settings->get("social_{$network}") }}" target="_blank" rel="noopener"
                                class="flex h-9 w-9 items-center justify-center rounded-lg border border-ink-200 text-ink-500 transition-all duration-200 hover:border-accent-500 hover:bg-accent-50 hover:text-accent-600"
                                aria-label="{{ ucfirst($network) }}">
                                @if ($network === 'linkedin')
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                @elseif ($network === 'twitter')
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                @else
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <h2 class="eyebrow mb-5 text-accent-600">Expertise</h2>
                <ul class="space-y-2.5">
                    @foreach ($footerServices as $service)
                        <li>
                            <a href="{{ route('expertise.show', $service->slug) }}" class="text-sm leading-relaxed text-ink-500 transition-colors hover:text-accent-600">
                                {{ $service->name }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('expertise.index') }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-ink-800 transition-colors hover:text-accent-600">
                            All expertise <x-icon name="arrow-long-right" class="h-3.5 w-3.5" />
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h2 class="eyebrow mb-5 text-accent-600">Company</h2>
                <ul class="space-y-2.5">
                    @foreach ([['company-overview', 'Company Overview'], ['our-team', 'Our Team'], ['why-choose-us', 'Why Choose Us'], ['business-models', 'Business Models'], ['case-studies.index', 'Case Studies'], ['insights.index', 'Insights'], ['careers', 'Careers'], ['contact', 'Contact Us']] as [$routeName, $label])
                        <li>
                            <a href="{{ route($routeName) }}" class="text-sm text-ink-500 transition-colors hover:text-accent-600">{{ $label }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="eyebrow mb-5 text-accent-600">Office</h2>
                <div class="space-y-5 text-sm text-ink-500">
                    <div>
                        <p class="mb-1.5 font-semibold uppercase tracking-wide text-ink-800">Registered office</p>
                        <p class="leading-relaxed">{{ $settings->get('address_india', 'Bangalore, Karnataka, India') }}</p>
                    </div>

                    @if ($settings->get('phone'))
                        <a href="tel:{{ $settings->get('phone') }}" class="flex items-center gap-2 transition-colors hover:text-accent-600">
                            <x-icon name="phone" class="h-4 w-4 shrink-0 text-accent-500" />
                            {{ $settings->get('phone') }}
                        </a>
                    @endif

                    @if ($settings->get('contact_email'))
                        <a href="mailto:{{ $settings->get('contact_email') }}" class="flex items-center gap-2 break-all transition-colors hover:text-accent-600">
                            <x-icon name="envelope" class="h-4 w-4 shrink-0 text-accent-500" />
                            {{ $settings->get('contact_email') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-col items-center justify-between gap-4 border-t border-ink-200 py-6 md:flex-row">
            <p class="text-xs text-ink-400">
                {!! $settings->get('footer_text', '© '.date('Y').' '.$settings->get('site_name', 'WaterFirst').'. All rights reserved.') !!}
            </p>
            <div class="flex flex-wrap gap-5 text-xs text-ink-400">
                <a href="{{ route('page.show', 'privacy-policy') }}" class="transition-colors hover:text-accent-600">Privacy Policy</a>
                <a href="{{ route('page.show', 'terms-conditions') }}" class="transition-colors hover:text-accent-600">Terms &amp; Conditions</a>
                <a href="{{ route('sitemap') }}" class="transition-colors hover:text-accent-600">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
