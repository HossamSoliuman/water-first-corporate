@php
    $navLogo = $settings->get('logo_url') ?: 'images/waterfirst-logo.png';
    $navSocials = collect(['linkedin', 'twitter', 'facebook', 'instagram'])
        ->filter(fn ($network) => (bool) $settings->get("social_{$network}"));
    $navRegions = config('regions', []);
@endphp

<header id="site-header" class="sticky top-0 z-50 bg-white/95 backdrop-blur-sm" x-data="{ mobileOpen: false }">

    {{-- ═══ UTILITY BAR ═══ --}}
    <div class="hidden border-b border-ink-100 lg:block">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-2.5 sm:px-6 lg:px-8">
            {{-- Contact --}}
            <div class="flex items-center gap-6">
                @if ($settings->get('address_india'))
                    <span class="hidden items-center gap-2 text-[11px] font-medium text-ink-500 xl:flex">
                        <x-icon name="map-pin" class="h-3.5 w-3.5 text-accent-500" />
                        {{ $settings->get('address_india') }}
                    </span>
                @endif

                @if ($settings->get('contact_email'))
                    <a href="mailto:{{ $settings->get('contact_email') }}" class="flex items-center gap-2 text-[11px] font-medium text-ink-500 transition-colors hover:text-accent-600">
                        <x-icon name="envelope" class="h-3.5 w-3.5 text-accent-500" />
                        {{ $settings->get('contact_email') }}
                    </a>
                @endif

                @if ($settings->get('phone'))
                    <a href="tel:{{ $settings->get('phone') }}" class="hidden items-center gap-2 text-[11px] font-medium text-ink-500 transition-colors hover:text-accent-600 xl:flex">
                        <x-icon name="phone" class="h-3.5 w-3.5 text-accent-500" />
                        {{ $settings->get('phone') }}
                    </a>
                @endif
            </div>

            {{-- Regions --}}
            <div class="flex items-center gap-6">
                <nav class="flex items-center gap-5" aria-label="Regions">
                    @foreach ($navRegions as $key => $region)
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button type="button" @click="open = !open" :aria-expanded="open"
                                class="flex items-center gap-1 text-[11px] font-semibold uppercase tracking-[.16em] text-ink-500 transition-colors hover:text-accent-600">
                                {{ $region['label'] }}
                                <x-icon name="chevron-down" class="h-3 w-3 transition-transform duration-200" ::class="open ? 'rotate-180' : ''" />
                            </button>
                            <div x-show="open" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute right-0 top-full z-50 mt-2 w-56 rounded-2xl border border-ink-100 bg-white p-2 shadow-2xl shadow-ink-900/10">
                                <ul class="space-y-px">
                                    @foreach ($region['countries'] as $country)
                                        <li class="flex items-center gap-2.5 rounded-lg px-3 py-1.5 text-xs font-medium text-ink-700">
                                            <span class="h-1 w-1 shrink-0 rounded-full bg-accent-500" aria-hidden="true"></span>
                                            {{ $country }}
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-1 border-t border-ink-100 pt-2">
                                    <a href="{{ route('contact') }}" class="group/region flex items-center gap-2 rounded-lg px-3 py-1.5 text-[11px] font-semibold text-accent-600 transition-colors hover:text-accent-700">
                                        Talk to our {{ $region['label'] }} team
                                        <x-icon name="arrow-long-right" class="h-3.5 w-3.5 arrow-nudge" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </nav>

                @foreach ($navSocials as $network)
                    <a href="{{ $settings->get("social_{$network}") }}" target="_blank" rel="noopener"
                        class="text-ink-400 transition-colors hover:text-accent-600" aria-label="{{ ucfirst($network) }}">
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
        </div>
    </div>

    {{-- ═══ MAIN BAR ═══ --}}
    <div class="border-b border-ink-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between gap-8">

                <a href="{{ route('home') }}" class="group flex shrink-0 items-center" aria-label="{{ $settings->get('site_name', 'WaterFirst') }} home">
                    <span class="relative flex items-center">
                        <span class="ripple-pulse absolute -inset-3 rounded-full bg-accent-200/40" aria-hidden="true"></span>
                        <img src="{{ asset($navLogo) }}" alt="{{ $settings->get('site_name', 'WaterFirst') }}" class="relative z-10 h-11 w-auto">
                    </span>
                </a>

                <nav class="hidden items-center gap-8 lg:flex" aria-label="Primary navigation">
                    <a href="{{ route('home') }}" class="text-sm font-medium tracking-wide text-ink-800 transition-colors hover:text-accent-600">Home</a>

                    {{-- About --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button type="button" @click="open = !open" :aria-expanded="open"
                            class="flex items-center gap-1 text-sm font-medium tracking-wide text-ink-800 transition-colors hover:text-accent-600">
                            About Us
                            <x-icon name="chevron-down" class="h-3.5 w-3.5 transition-transform duration-200" ::class="open ? 'rotate-180' : ''" />
                        </button>
                        <div x-show="open" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute left-1/2 top-full z-50 mt-3 w-64 -translate-x-1/2 rounded-2xl border border-ink-100 bg-white p-2 shadow-2xl shadow-ink-900/10">
                            @foreach ([['company-overview', 'building-office-2', 'Company Overview'], ['our-team', 'users', 'Our Team'], ['why-choose-us', 'shield-check', 'Why Choose Us'], ['business-models', 'squares-2x2', 'Business Models']] as [$routeName, $icon, $label])
                                <a href="{{ route($routeName) }}" class="group/item flex items-center gap-3 rounded-xl px-3 py-2.5 transition-colors hover:bg-surface">
                                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-accent-50 text-accent-600 transition-all group-hover/item:bg-accent-500 group-hover/item:text-white">
                                        <x-icon name="{{ $icon }}" class="h-4 w-4" />
                                    </span>
                                    <span class="text-sm font-medium leading-tight text-ink-800">{{ $label }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- Expertise --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button type="button" @click="open = !open" :aria-expanded="open"
                            class="flex items-center gap-1 text-sm font-medium tracking-wide text-ink-800 transition-colors hover:text-accent-600">
                            Expertise
                            <x-icon name="chevron-down" class="h-3.5 w-3.5 transition-transform duration-200" ::class="open ? 'rotate-180' : ''" />
                        </button>
                        <div x-show="open" x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute left-1/2 top-full z-50 mt-3 w-[560px] -translate-x-1/2 rounded-2xl border border-ink-100 bg-white p-5 shadow-2xl shadow-ink-900/10">
                            <div class="grid grid-cols-2 gap-1">
                                @foreach ($footerServices as $service)
                                    <a href="{{ route('expertise.show', $service->slug) }}" class="group/item flex items-center gap-3 rounded-xl px-3 py-2.5 transition-colors hover:bg-surface">
                                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-accent-50 text-accent-600 transition-all group-hover/item:bg-accent-500 group-hover/item:text-white">
                                            <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-4 w-4" />
                                        </span>
                                        <span class="text-xs font-medium leading-tight text-ink-800">{{ $service->name }}</span>
                                    </a>
                                @endforeach
                            </div>
                            <div class="mt-3 border-t border-ink-100 pt-3">
                                <a href="{{ route('expertise.index') }}" class="group/all flex items-center gap-2 text-xs font-semibold text-accent-600 transition-colors hover:text-accent-700">
                                    View all expertise
                                    <x-icon name="arrow-long-right" class="h-4 w-4" />
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('case-studies.index') }}" class="text-sm font-medium tracking-wide text-ink-800 transition-colors hover:text-accent-600">Case Studies</a>
                    <a href="{{ route('insights.index') }}" class="text-sm font-medium tracking-wide text-ink-800 transition-colors hover:text-accent-600">Insights</a>
                    <a href="{{ route('careers') }}" class="text-sm font-medium tracking-wide text-ink-800 transition-colors hover:text-accent-600">Careers</a>

                    <a href="{{ route('contact') }}" class="wf-btn-primary group ml-2 px-5 py-2.5 text-sm">
                        Get in Touch
                        <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                    </a>
                </nav>

                <button type="button" @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen"
                    class="rounded-lg p-2 text-ink-700 transition-colors hover:bg-surface lg:hidden" aria-label="Toggle navigation">
                    <x-icon name="bars-3" class="h-6 w-6" x-show="!mobileOpen" />
                    <x-icon name="x-mark" class="h-6 w-6" x-show="mobileOpen" x-cloak />
                </button>
            </div>
        </div>
    </div>

    {{-- ═══ MOBILE ═══ --}}
    <div x-show="mobileOpen" x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="border-b border-ink-100 bg-white lg:hidden">
        <div class="mx-auto max-w-7xl space-y-1 px-4 py-4">
            <a href="{{ route('home') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-ink-800 transition-colors hover:bg-surface">Home</a>

            <p class="px-4 pb-1 pt-3 text-xs font-semibold uppercase tracking-widest text-ink-400">About Us</p>
            @foreach ([['company-overview', 'Company Overview'], ['our-team', 'Our Team'], ['why-choose-us', 'Why Choose Us'], ['business-models', 'Business Models']] as [$routeName, $label])
                <a href="{{ route($routeName) }}" class="block rounded-xl px-6 py-2.5 text-sm font-medium text-ink-800 transition-colors hover:bg-surface">{{ $label }}</a>
            @endforeach

            @foreach ([['expertise.index', 'Expertise'], ['case-studies.index', 'Case Studies'], ['insights.index', 'Insights'], ['careers', 'Careers']] as [$routeName, $label])
                <a href="{{ route($routeName) }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-ink-800 transition-colors hover:bg-surface">{{ $label }}</a>
            @endforeach

            <a href="{{ route('contact') }}" class="wf-btn-primary mt-2 w-full">Get in Touch</a>

            @if (count($navRegions))
                <div class="mt-4 border-t border-ink-100 pt-4">
                    <p class="px-4 pb-2 text-xs font-semibold uppercase tracking-widest text-ink-400">Regions</p>
                    @foreach ($navRegions as $region)
                        <div x-data="{ open: false }" class="px-4 py-1">
                            <button type="button" @click="open = !open" :aria-expanded="open"
                                class="flex w-full items-center justify-between py-1.5 text-sm font-medium text-ink-800">
                                {{ $region['label'] }}
                                <x-icon name="chevron-down" class="h-3.5 w-3.5 text-ink-400 transition-transform duration-200" ::class="open ? 'rotate-180' : ''" />
                            </button>
                            <ul x-show="open" x-cloak class="pb-2 pl-3">
                                @foreach ($region['countries'] as $country)
                                    <li class="flex items-center gap-2.5 py-1 text-xs text-ink-500">
                                        <span class="h-1 w-1 shrink-0 rounded-full bg-accent-500" aria-hidden="true"></span>
                                        {{ $country }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</header>
