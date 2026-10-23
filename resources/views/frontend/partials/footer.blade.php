@php
    $footerLogo = 'images/waterfirst-logo-white.png';
    $footerSocials = collect(['linkedin', 'twitter', 'facebook', 'instagram'])
        ->filter(fn ($network) => (bool) $settings->get("social_{$network}"));
@endphp

<footer class="bg-ink-950 text-ink-300">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="grid gap-10 border-b border-white/10 py-16 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <img src="{{ asset($footerLogo) }}" alt="{{ $settings->get('site_name', 'WaterFirst') }}" class="h-12 w-auto">
                <p class="mt-6 max-w-sm text-sm leading-7 text-ink-300">
                    Multi-disciplinary engineering and infrastructure consultancy delivering technically robust, compliant solutions across the full project lifecycle.
                </p>

                @if ($footerSocials->count())
                    <div class="mt-6 flex flex-wrap gap-x-5 gap-y-2 font-mono text-[11px] uppercase tracking-[.12em]">
                        @foreach ($footerSocials as $network)
                            <a href="{{ $settings->get("social_{$network}") }}" target="_blank" rel="noopener" class="text-ink-200 transition-colors hover:text-accent-300">
                                {{ $network === 'twitter' ? 'X' : ucfirst($network) }} ↗
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="sm:grid sm:grid-cols-3 sm:gap-10 lg:col-span-8">
                <div>
                    <h2 class="font-mono text-[11px] font-medium uppercase tracking-[.14em] text-accent-300">Expertise</h2>
                    <ul class="mt-5 space-y-2.5">
                        @foreach ($footerServices as $service)
                            <li>
                                <a href="{{ route('expertise.show', $service->slug) }}" class="text-sm leading-snug text-ink-200 transition-colors hover:text-white">{{ $service->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-10 sm:mt-0">
                    <h2 class="font-mono text-[11px] font-medium uppercase tracking-[.14em] text-accent-300">Company</h2>
                    <ul class="mt-5 space-y-2.5">
                        @foreach ([['company-overview', 'Company Overview'], ['our-team', 'Our Team'], ['why-choose-us', 'Why Choose Us'], ['business-models', 'Business Models'], ['case-studies.index', 'Case Studies'], ['insights.index', 'Insights'], ['careers', 'Careers'], ['contact', 'Contact Us']] as [$routeName, $label])
                            <li>
                                <a href="{{ route($routeName) }}" class="text-sm text-ink-200 transition-colors hover:text-white">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="mt-10 sm:mt-0">
                    <h2 class="font-mono text-[11px] font-medium uppercase tracking-[.14em] text-accent-300">Office</h2>
                    <address class="mt-5 space-y-5 text-sm not-italic text-ink-200">
                        <p class="leading-6">41021, Sobha Dream Acres,<br>Bangalore, Karnataka, India</p>
                        <div class="space-y-1.5 font-mono text-[13px]">
                            <a href="tel:+919886208825" class="block transition-colors hover:text-white"><span class="text-ink-400">IN</span> +91 98862 08825</a>
                            @if ($settings->get('phone'))
                                <a href="tel:{{ $settings->get('phone') }}" class="block transition-colors hover:text-white"><span class="text-ink-400">US</span> {{ $settings->get('phone') }}</a>
                            @endif
                        </div>
                        @if ($settings->get('contact_email'))
                            <a href="mailto:{{ $settings->get('contact_email') }}" class="block break-all transition-colors hover:text-white">{{ $settings->get('contact_email') }}</a>
                        @endif
                    </address>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 py-6 text-xs text-ink-400 md:flex-row md:items-center md:justify-between">
            <p>{!! $settings->get('footer_text', '© '.date('Y').' '.$settings->get('site_name', 'WaterFirst').'. All rights reserved.') !!}</p>
            <div class="flex flex-wrap gap-5">
                <a href="{{ route('page.show', 'privacy-policy') }}" class="transition-colors hover:text-white">Privacy Policy</a>
                <a href="{{ route('page.show', 'terms-conditions') }}" class="transition-colors hover:text-white">Terms &amp; Conditions</a>
                <a href="{{ route('sitemap') }}" class="transition-colors hover:text-white">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
