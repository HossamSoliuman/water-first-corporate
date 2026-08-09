<header id="site-header" class="sticky top-0 z-50 border-b border-ink-200 bg-white/95 backdrop-blur-sm"
    x-data="{ mobileOpen: false }">
    <div class="border-b border-ink-100 bg-primary-600 text-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-2 sm:px-6 lg:px-8">
            <p class="font-mono text-[10px] uppercase tracking-[.18em] text-primary-100">Bangalore, India · Water &amp; environmental engineering</p>
            <a href="{{ route('contact') }}" class="hidden items-center gap-2 font-mono text-[10px] uppercase tracking-[.18em] text-white hover:text-accent-200 sm:flex">
                Start a project <x-icon name="arrow-long-right" class="h-3.5 w-3.5" />
            </a>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between gap-8">
            <a href="{{ route('home') }}" class="shrink-0" aria-label="WaterFirst home">
                <img src="{{ asset('images/waterfirst-logo.svg') }}" alt="WaterFirst" class="h-11 w-auto">
            </a>

            <nav class="hidden items-center gap-7 lg:flex" aria-label="Primary navigation">
                <a href="{{ route('home') }}" class="text-sm font-medium text-ink-700 transition-colors hover:text-primary-600">Home</a>

                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" @click="open = !open" class="flex items-center gap-1 text-sm font-medium text-ink-700 transition-colors hover:text-primary-600" :aria-expanded="open">
                        About
                        <x-icon name="chevron-down" class="h-3.5 w-3.5 transition-transform" ::class="open ? 'rotate-180' : ''" />
                    </button>
                    <div x-show="open" x-cloak x-transition
                        class="absolute left-1/2 top-full mt-4 w-64 -translate-x-1/2 border border-ink-200 bg-white p-2 shadow-soft">
                        @foreach ([['company-overview', '01', 'Company Overview'], ['our-team', '02', 'Our Team'], ['why-choose-us', '03', 'Why Choose Us'], ['business-models', '04', 'Business Models']] as [$routeName, $index, $label])
                            <a href="{{ route($routeName) }}" class="group flex items-center gap-3 border-b border-ink-100 px-3 py-3 last:border-0 hover:bg-surface">
                                <span class="font-mono text-[10px] text-accent-600">{{ $index }}</span>
                                <span class="text-sm font-medium text-ink-800 group-hover:text-primary-600">{{ $label }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button type="button" @click="open = !open" class="flex items-center gap-1 text-sm font-medium text-ink-700 transition-colors hover:text-primary-600" :aria-expanded="open">
                        Expertise
                        <x-icon name="chevron-down" class="h-3.5 w-3.5 transition-transform" ::class="open ? 'rotate-180' : ''" />
                    </button>
                    <div x-show="open" x-cloak x-transition
                        class="absolute left-1/2 top-full mt-4 w-[640px] -translate-x-1/2 border border-ink-200 bg-white p-5 shadow-soft">
                        <div class="mb-4 flex items-center justify-between border-b border-ink-200 pb-3">
                            <p class="section-index">DISCIPLINES / {{ str_pad($footerServices->count(), 2, '0', STR_PAD_LEFT) }}</p>
                            <a href="{{ route('expertise.index') }}" class="text-xs font-semibold text-primary-600 hover:text-secondary-500">View all expertise</a>
                        </div>
                        <div class="grid grid-cols-2 gap-x-5">
                            @foreach ($footerServices as $service)
                                <a href="{{ route('expertise.show', $service->slug) }}" class="group flex items-start gap-3 border-b border-ink-100 py-3 hover:text-primary-600">
                                    <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center border border-accent-500 text-accent-600">
                                        <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-3.5 w-3.5" />
                                    </span>
                                    <span class="text-xs font-medium leading-snug text-ink-700 group-hover:text-primary-600">{{ $service->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('case-studies.index') }}" class="text-sm font-medium text-ink-700 transition-colors hover:text-primary-600">Projects</a>
                <a href="{{ route('insights.index') }}" class="text-sm font-medium text-ink-700 transition-colors hover:text-primary-600">Insights</a>
                <a href="{{ route('careers') }}" class="text-sm font-medium text-ink-700 transition-colors hover:text-primary-600">Careers</a>
                <a href="{{ route('contact') }}" class="wf-btn-primary px-5 py-2.5">Contact</a>
            </nav>

            <button type="button" @click="mobileOpen = !mobileOpen" class="border border-ink-200 p-2.5 text-ink-800 lg:hidden" aria-label="Toggle navigation" :aria-expanded="mobileOpen">
                <x-icon name="bars-3" class="h-5 w-5" x-show="!mobileOpen" />
                <x-icon name="x-mark" class="h-5 w-5" x-show="mobileOpen" x-cloak />
            </button>
        </div>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition class="border-t border-ink-200 bg-white lg:hidden">
        <nav class="mx-auto grid max-w-7xl gap-1 px-4 py-5 sm:px-6" aria-label="Mobile navigation">
            @foreach ([['home', 'Home'], ['company-overview', 'Company Overview'], ['why-choose-us', 'Why Choose Us'], ['our-team', 'Our Team'], ['business-models', 'Business Models'], ['expertise.index', 'Expertise'], ['case-studies.index', 'Projects'], ['insights.index', 'Insights'], ['careers', 'Careers'], ['contact', 'Contact']] as [$routeName, $label])
                <a href="{{ route($routeName) }}" class="flex items-center justify-between border-b border-ink-100 px-2 py-3 text-sm font-medium text-ink-800 hover:text-primary-600">
                    {{ $label }}
                    <x-icon name="arrow-long-right" class="h-4 w-4 text-accent-600" />
                </a>
            @endforeach
        </nav>
    </div>
</header>
