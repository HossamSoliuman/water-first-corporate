@php
    $navLogo = $settings->get('logo_url') ?: 'images/waterfirst-logo.png';
    $navSocials = collect(['linkedin', 'twitter', 'facebook', 'instagram'])
        ->filter(fn ($network) => (bool) $settings->get("social_{$network}"));
    $navRegions = config('regions', []);
    $aboutLinks = [
        ['company-overview', 'Company Overview'],
        ['our-team', 'Our Team'],
        ['why-choose-us', 'Why Choose Us'],
        ['business-models', 'Business Models'],
    ];
    $navLinkClass = fn (bool $active) => 'relative flex h-full items-center text-[15px] font-medium transition-colors '
        .($active ? 'text-primary-600 after:absolute after:inset-x-0 after:bottom-0 after:h-[3px] after:bg-accent-500' : 'text-ink-800 hover:text-primary-600');
@endphp

<header id="site-header" class="sticky top-0 z-50 bg-white" x-data="{ mobileOpen: false, panel: null }" @keydown.escape.window="panel = null">

    {{-- ═══ CONTACT STRIP ═══ --}}
    <div class="hidden bg-ink-900 text-ink-200 lg:block">
        <div class="mx-auto flex h-10 max-w-7xl items-center justify-between gap-6 px-4 font-mono text-[11px] sm:px-6 lg:px-8">
            <div class="flex items-center gap-6">
                @if ($settings->get('contact_email'))
                    <a href="mailto:{{ $settings->get('contact_email') }}" class="transition-colors hover:text-white">{{ $settings->get('contact_email') }}</a>
                @endif
                <a href="tel:+919886208825" class="transition-colors hover:text-white"><span class="text-accent-300">IN</span> +91 98862 08825</a>
                @if ($settings->get('phone'))
                    <a href="tel:{{ $settings->get('phone') }}" class="transition-colors hover:text-white"><span class="text-accent-300">US</span> {{ $settings->get('phone') }}</a>
                @endif
            </div>

            <div class="flex items-center gap-5">
                @foreach ($navSocials as $network)
                    <a href="{{ $settings->get("social_{$network}") }}" target="_blank" rel="noopener" class="uppercase tracking-[.12em] transition-colors hover:text-white" aria-label="{{ ucfirst($network) }}">
                        {{ $network === 'twitter' ? 'X' : ucfirst($network) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ═══ MAIN BAR ═══ --}}
    <div class="relative border-b border-line" @mouseleave="panel = null">
        <div class="mx-auto flex h-[76px] max-w-7xl items-stretch justify-between gap-8 px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex shrink-0 items-center" aria-label="{{ $settings->get('site_name', 'WaterFirst') }} home">
                <img src="{{ asset($navLogo) }}" alt="{{ $settings->get('site_name', 'WaterFirst') }}" class="h-11 w-auto">
            </a>

            <nav class="hidden items-stretch gap-7 lg:flex" aria-label="Primary navigation">
                <button type="button" @click="panel = panel === 'about' ? null : 'about'" @mouseenter="panel = 'about'" :aria-expanded="panel === 'about'"
                    class="{{ $navLinkClass(request()->routeIs('company-overview', 'our-team', 'why-choose-us', 'business-models')) }} gap-1.5">
                    About
                    <x-icon name="chevron-down" class="h-3.5 w-3.5 transition-transform" ::class="panel === 'about' ? 'rotate-180' : ''" />
                </button>
                <button type="button" @click="panel = panel === 'expertise' ? null : 'expertise'" @mouseenter="panel = 'expertise'" :aria-expanded="panel === 'expertise'"
                    class="{{ $navLinkClass(request()->routeIs('expertise.*')) }} gap-1.5">
                    Expertise
                    <x-icon name="chevron-down" class="h-3.5 w-3.5 transition-transform" ::class="panel === 'expertise' ? 'rotate-180' : ''" />
                </button>
                <a href="{{ route('case-studies.index') }}" @mouseenter="panel = null" class="{{ $navLinkClass(request()->routeIs('case-studies.*')) }}">Case Studies</a>
                <a href="{{ route('insights.index') }}" @mouseenter="panel = null" class="{{ $navLinkClass(request()->routeIs('insights.*')) }}">Insights</a>
                <a href="{{ route('careers') }}" @mouseenter="panel = null" class="{{ $navLinkClass(request()->routeIs('careers')) }}">Careers</a>
                @if (count($navRegions))
                    <button type="button" @click="panel = panel === 'regions' ? null : 'regions'" @mouseenter="panel = 'regions'" :aria-expanded="panel === 'regions'"
                        class="{{ $navLinkClass(false) }} gap-1.5">
                        Regions
                        <x-icon name="chevron-down" class="h-3.5 w-3.5 transition-transform" ::class="panel === 'regions' ? 'rotate-180' : ''" />
                    </button>
                @endif
            </nav>

            <div class="flex items-center gap-3">
                <a href="{{ route('contact') }}" class="wf-btn-primary group hidden lg:inline-flex">
                    Start a project
                    <x-icon name="arrow-long-right" class="arrow-nudge h-4 w-4" />
                </a>
                <button type="button" @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen"
                    class="rounded border border-line p-2 text-ink-800 lg:hidden" aria-label="Toggle navigation">
                    <x-icon name="bars-3" class="h-6 w-6" x-show="!mobileOpen" />
                    <x-icon name="x-mark" class="h-6 w-6" x-show="mobileOpen" x-cloak />
                </button>
            </div>
        </div>

        {{-- ═══ DROPDOWN PANELS (full width) ═══ --}}
        <div x-show="panel" x-cloak
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-end="opacity-0"
            class="absolute inset-x-0 top-full hidden border-b border-line bg-white shadow-soft lg:block">
            <div class="mx-auto max-w-7xl px-8 py-8">

                <div x-show="panel === 'about'" class="grid grid-cols-12 gap-10">
                    <div class="col-span-4 border-r border-line pr-10">
                        <p class="eyebrow">About</p>
                        <p class="mt-4 font-heading text-xl font-semibold leading-snug text-ink-900">An engineering practice that starts with water.</p>
                    </div>
                    <div class="col-span-8 grid grid-cols-2 gap-x-10">
                        @foreach ($aboutLinks as [$routeName, $label])
                            <a href="{{ route($routeName) }}" class="group flex items-center justify-between gap-4 border-b border-line py-4">
                                <span class="font-heading text-base font-semibold text-ink-900 group-hover:text-primary-600">{{ $label }}</span>
                                <x-icon name="arrow-long-right" class="h-4 w-4 shrink-0 text-ink-300 transition-colors group-hover:text-accent-500" />
                            </a>
                        @endforeach
                    </div>
                </div>

                <div x-show="panel === 'expertise'" class="grid grid-cols-12 gap-10">
                    <div class="col-span-4 border-r border-line pr-10">
                        <p class="eyebrow">Expertise</p>
                        <p class="mt-4 font-heading text-xl font-semibold leading-snug text-ink-900">{{ $footerServices->count() }} engineering disciplines, delivered as one team.</p>
                        <a href="{{ route('expertise.index') }}" class="group mt-6 inline-flex items-center gap-2 text-sm font-semibold text-primary-600">
                            View all expertise <x-icon name="arrow-long-right" class="arrow-nudge h-4 w-4" />
                        </a>
                    </div>
                    <div class="col-span-8 grid grid-cols-2 gap-x-10">
                        @foreach ($footerServices as $service)
                            <a href="{{ route('expertise.show', $service->slug) }}" class="group flex items-center gap-3 border-b border-line py-3">
                                <span class="w-5 shrink-0 text-center text-ink-400 transition-colors group-hover:text-accent-500">
                                    <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-5 w-5" />
                                </span>
                                <span class="flex-1 text-sm font-medium text-ink-800 group-hover:text-primary-600">{{ $service->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                @if (count($navRegions))
                    <div x-show="panel === 'regions'" class="grid grid-cols-12 gap-10">
                        <div class="col-span-3 border-r border-line pr-10">
                            <p class="eyebrow">Regions</p>
                            <p class="mt-4 font-heading text-xl font-semibold leading-snug text-ink-900">Where our teams deliver.</p>
                            <a href="{{ route('contact') }}" class="group mt-6 inline-flex items-center gap-2 text-sm font-semibold text-primary-600">
                                Talk to a regional team <x-icon name="arrow-long-right" class="arrow-nudge h-4 w-4" />
                            </a>
                        </div>
                        <div class="col-span-9 grid grid-cols-5 gap-6">
                            @foreach ($navRegions as $region)
                                <div>
                                    <p class="border-b-2 border-accent-500 pb-2 font-heading text-sm font-semibold text-ink-900">{{ $region['label'] }}</p>
                                    <ul class="mt-3 space-y-1.5">
                                        @foreach ($region['countries'] as $country)
                                            <li class="text-sm text-ink-600">{{ $country }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ═══ MOBILE ═══ --}}
    <div x-show="mobileOpen" x-cloak x-transition.opacity class="max-h-[calc(100svh-76px)] overflow-y-auto border-b border-line bg-white lg:hidden">
        <div class="space-y-6 px-4 py-6 sm:px-6">
            <div>
                <p class="eyebrow">About</p>
                <div class="mt-2">
                    @foreach ($aboutLinks as [$routeName, $label])
                        <a href="{{ route($routeName) }}" class="block border-b border-line py-3 text-base font-medium text-ink-800">{{ $label }}</a>
                    @endforeach
                </div>
            </div>
            <div>
                <p class="eyebrow">Explore</p>
                <div class="mt-2">
                    @foreach ([['expertise.index', 'Expertise'], ['case-studies.index', 'Case Studies'], ['insights.index', 'Insights'], ['careers', 'Careers'], ['contact', 'Contact']] as [$routeName, $label])
                        <a href="{{ route($routeName) }}" class="block border-b border-line py-3 text-base font-medium text-ink-800">{{ $label }}</a>
                    @endforeach
                </div>
            </div>

            @if (count($navRegions))
                <div>
                    <p class="eyebrow">Regions</p>
                    <div class="mt-2">
                        @foreach ($navRegions as $region)
                            <div x-data="{ open: false }" class="border-b border-line">
                                <button type="button" @click="open = !open" :aria-expanded="open" class="flex w-full items-center justify-between py-3 text-base font-medium text-ink-800">
                                    {{ $region['label'] }}
                                    <x-icon name="chevron-down" class="h-4 w-4 text-ink-400 transition-transform" ::class="open ? 'rotate-180' : ''" />
                                </button>
                                <p x-show="open" x-cloak class="pb-3 text-sm leading-6 text-ink-500">{{ implode(' · ', $region['countries']) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <a href="{{ route('contact') }}" class="wf-btn-primary w-full">Start a project</a>
        </div>
    </div>
</header>
