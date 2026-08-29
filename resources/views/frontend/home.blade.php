@extends('layouts.app')

@section('content')
    {{-- ═══ HERO ═══ --}}
    <section class="relative flex min-h-[calc(100svh-8.5rem)] items-center overflow-hidden py-20">
        <div class="absolute inset-0 z-0">
            <video
                data-hero-video
                class="h-full w-full object-cover"
                poster="{{ asset('images/waterfirst-hero-poster.jpg') }}"
                autoplay muted loop playsinline preload="metadata"
                aria-hidden="true" tabindex="-1" disablepictureinpicture
            >
                <source src="{{ $heroVideo?->url ?? asset('videos/hero-water-treatment.mp4') }}">
            </video>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-950/92 via-primary-900/72 to-transparent"></div>
        </div>

        <svg class="pointer-events-none absolute inset-x-0 bottom-0 z-[1] h-28 w-full text-accent-300/30" viewBox="0 0 1440 120" preserveAspectRatio="none" aria-hidden="true" fill="none">
            <path class="flow-stroke" stroke="currentColor" stroke-width="1.5" d="M0 74c160-40 260 34 420 6s250-56 400-24 300 62 420 26 200-30 200-30"/>
            <path class="flow-stroke-slow" stroke="currentColor" stroke-width="1.5" d="M0 100c170-38 250 30 430 4s240-52 396-20 306 58 414 24 200-26 200-26"/>
        </svg>

        <div class="relative z-10 mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl rounded-2xl border border-white/10 bg-primary-950/45 p-8 backdrop-blur-md md:p-10">
                <p class="reveal eyebrow eyebrow-light mb-5">{{ $settings->get('site_tagline', 'Engineering Water, Sustainably') }}</p>

                <h1 class="reveal delay-100 mb-6 font-heading text-4xl font-bold leading-[1.05] tracking-tight text-white md:text-6xl">
                    Engineering Clarity<br>
                    <span class="text-accent-300">For Every Drop.</span>
                </h1>

                <p class="reveal delay-200 mb-10 text-lg leading-relaxed text-primary-100">
                    A multi-disciplinary engineering and infrastructure consultancy delivering water-led, high-performance
                    solutions across every phase of the project lifecycle.
                </p>

                <div class="reveal delay-300 flex flex-col gap-4 sm:flex-row">
                    <a href="{{ route('expertise.index') }}" class="wf-btn-primary group px-8 py-4">
                        Explore Expertise
                        <x-icon name="arrow-long-right" class="h-5 w-5 arrow-nudge" />
                    </a>
                    <a href="{{ route('case-studies.index') }}" class="wf-btn-outline wf-btn-outline-light group px-8 py-4 backdrop-blur-sm">
                        View Case Studies
                        <x-icon name="arrow-long-right" class="h-5 w-5 arrow-nudge" />
                    </a>
                </div>
            </div>
        </div>

        <a href="#site-metrics" class="absolute inset-x-0 bottom-8 z-10 mx-auto hidden w-max flex-col items-center gap-2 text-primary-200 transition-colors hover:text-white lg:flex" aria-label="Scroll to key figures">
            <span class="text-xs uppercase tracking-widest">Scroll</span>
            <x-icon name="chevron-down" class="scroll-cue h-4 w-4" />
        </a>
    </section>

    {{-- ═══ STATS ═══ --}}
    <section id="site-metrics" class="border-b border-ink-100 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
                @foreach ([
                    ['20', '+', 20, 'Years Founder Experience', 'Water and wastewater treatment'],
                    ['15–35', '', null, 'Years Per Discipline', 'Senior engineers on every project'],
                    [$expertiseServices->count(), '', $expertiseServices->count(), 'Engineering Disciplines', 'Delivered as integrated solutions'],
                    [$industries->count(), '', $industries->count(), 'Industries Served', 'Public and industrial sectors'],
                ] as $index => [$value, $suffix, $countTo, $label, $detail])
                    <div class="reveal text-center {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }}">
                        <div class="mb-1 font-display text-5xl font-bold text-ink-900 md:text-6xl">
                            @if ($countTo)
                                <span data-count-to="{{ $countTo }}" data-count-suffix="{{ $suffix }}">{{ $value }}{{ $suffix }}</span>
                            @else
                                {{ $value }}{{ $suffix }}
                            @endif
                        </div>
                        <div class="text-sm font-semibold uppercase tracking-wide text-secondary-500">{{ $label }}</div>
                        <div class="mt-0.5 text-xs text-ink-400">{{ $detail }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ ABOUT STRIP ═══ --}}
    <section class="bg-surface py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-16 lg:grid-cols-2">
                <div class="reveal-left">
                    <p class="eyebrow mb-4">Who We Are</p>
                    <h2 class="mb-6 font-heading text-4xl leading-tight text-ink-900 md:text-5xl">
                        Engineering Water Systems <br>
                        <span class="text-accent-600">for Sustainable Communities</span>
                    </h2>
                    <p class="mb-6 leading-relaxed text-ink-500">
                        WaterFirst is a leading engineering consultancy providing specialized services across water, wastewater, environmental, and infrastructure sectors. Our expertise spans the entire asset lifecycle, from strategic planning and feasibility assessment to detailed engineering, construction support, and ongoing operational services.
                    </p>
                    <p class="mb-8 leading-relaxed text-ink-500">
                        By integrating technical innovation, industry best practices, and client-focused delivery, we create solutions that enhance operational efficiency, ensure regulatory compliance, and deliver measurable long-term value.
                    </p>
                </div>

                <div class="reveal-right grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @foreach ([
                        ['light-bulb', 'Advanced Technical Capabilities', ' Practical and innovative engineering solutions tailored to project-specific challenges'],
                        ['map-pin', 'Environmentally Responsible Design', ' Engineering outcomes that balance performance, sustainability, and environmental stewardship'],
                        ['users', 'Client-Centric Project Delivery', ' Transparent collaboration and stakeholder engagement throughout all project phases'],
                        ['scale', 'Optimized Whole-of-Life Value', ' Cost-effective infrastructure solutions that support reliability, resilience, and long-term asset performance'],
                    ] as [$icon, $title, $detail])
                        <div class="wf-panel group p-5 text-center sm:text-left">
                            <div class="wf-chip mx-auto mb-3 flex h-10 w-10 items-center justify-center sm:mx-0">
                                <x-icon name="{{ $icon }}" class="h-5 w-5" />
                            </div>
                            <h3 class="mb-1 text-sm font-semibold text-white">{{ $title }}</h3>
                            <p class="text-xs leading-relaxed text-primary-200">{{ $detail }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ EXPERTISE ═══ --}}
    @if ($featuredServices->count())
        <section class="bg-white py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="reveal mb-16 text-center">
                    <p class="eyebrow mb-4">What We Do</p>
                    <h2 class="mb-4 font-heading text-4xl text-ink-900 md:text-5xl">
                        Multi-Disciplinary Engineering<br>
                        <span class="text-accent-600">Built Around Water.</span>
                    </h2>
                    <p class="mx-auto max-w-xl text-ink-400">
                        Comprehensive engineering capabilities across every discipline, delivered as integrated solutions
                        from concept to completion.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($featuredServices as $index => $service)
                        <a href="{{ route('expertise.show', $service->slug) }}"
                            class="wf-panel group reveal flex flex-col p-7"
                            style="transition-delay: {{ $index * 80 }}ms">
                            <div class="mb-5 flex items-start justify-between">
                                <span class="wf-chip flex h-12 w-12 items-center justify-center">
                                    <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-6 w-6" />
                                </span>
                                <span class="text-accent-300 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                    <x-icon name="arrow-long-right" class="h-5 w-5" />
                                </span>
                            </div>
                            <h3 class="mb-2 font-heading text-lg leading-snug text-white">{{ $service->name }}</h3>
                            <p class="flex-1 text-sm leading-relaxed text-primary-200">{{ $service->short_description }}</p>
                            <div class="mt-5 border-t border-white/10 pt-4">
                                <span class="text-xs font-semibold uppercase tracking-wide text-accent-300">Learn More</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="reveal mt-10 text-center">
                    <a href="{{ route('expertise.index') }}" class="wf-btn-deep group px-8 py-4">
                        All Engineering Expertise
                        <x-icon name="arrow-long-right" class="h-5 w-5 arrow-nudge" />
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ PROJECT LIFECYCLE ═══ --}}
    <section class="bg-white pb-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="reveal eyebrow mb-4">Our Involvement</p>
            <div class="mb-20 grid items-start gap-10 lg:grid-cols-2 lg:gap-16">
                <div class="reveal-left">
                    <h2 class="font-heading text-3xl leading-tight text-ink-900 md:text-4xl">
                        Project Lifecycle. <span class="text-accent-600">Dedicated. Value Driven.</span>
                    </h2>
                </div>
                <p class="reveal-right leading-relaxed text-ink-400">
                    {{ $settings->get('site_name', 'WaterFirst') }} supports its partners at every stage — from early
                    planning and feasibility through detailed design, construction and handover. Backed by rigorous
                    engineering and digital workflows, we deliver accurate deliverables and practical solutions that keep
                    projects moving forward — an integrated extension of your team from concept to operations.
                </p>
            </div>

            @php
                $lifecycleSteps = [
                    ['num' => '01', 'icon' => 'fa-clipboard-list', 'title' => 'Feasibility & Tendering', 'desc' => 'Options studies, BOQs, conceptual design and bid support.'],
                    ['num' => '02', 'icon' => 'fa-compass-drafting', 'title' => 'Preliminary Design', 'desc' => 'Project setup, workflows, process selection and preliminary engineering.'],
                    ['num' => '03', 'icon' => 'fa-cube', 'title' => 'Detailed Design', 'desc' => 'Detailed engineering, coordination, IFC drawings and BIM models.'],
                    ['num' => '04', 'icon' => 'fa-helmet-safety', 'title' => 'Construction', 'desc' => 'Temporary works, quantities, utility coordination and RFI support.'],
                    ['num' => '05', 'icon' => 'fa-handshake', 'title' => 'Handover', 'desc' => 'As-built documentation, consolidated RFIs and coordinated models.'],
                    ['num' => '06', 'icon' => 'fa-gears', 'title' => 'Operations & Maintenance', 'desc' => 'Asset registers, optimisation and updated lifecycle data.'],
                ];
                $lastStep = count($lifecycleSteps) - 1;
            @endphp

            {{-- Desktop --}}
            <div class="reveal hidden grid-cols-6 lg:grid">
                @foreach ($lifecycleSteps as $index => $step)
                    <div class="group flex flex-col items-center text-center">
                        <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-surface ring-1 ring-ink-100 transition-all duration-300 group-hover:-translate-y-1 group-hover:bg-accent-500 group-hover:shadow-lg group-hover:shadow-accent-900/20 group-hover:ring-accent-500">
                            <i class="fa-solid {{ $step['icon'] }} text-2xl text-primary-600 transition-all duration-300 group-hover:scale-110 group-hover:text-white"></i>
                        </div>

                        <div class="relative mb-5 flex h-14 w-full items-center justify-center">
                            @unless ($index === 0)
                                <span class="absolute left-0 top-1/2 h-0.5 w-1/2 -translate-y-1/2 bg-ink-100"></span>
                            @endunless
                            @unless ($index === $lastStep)
                                <span class="absolute right-0 top-1/2 h-0.5 w-1/2 -translate-y-1/2 bg-ink-100"></span>
                            @endunless
                            <span class="relative z-10 flex h-14 w-14 items-center justify-center rounded-full border-2 border-accent-500 bg-white font-display text-lg font-bold text-accent-600 transition-all duration-300 group-hover:scale-110 group-hover:bg-accent-500 group-hover:text-white">{{ $step['num'] }}</span>
                        </div>

                        <div class="px-3">
                            <h3 class="mb-2 font-heading text-base font-bold leading-snug text-ink-900 transition-colors duration-300 group-hover:text-accent-700">{{ $step['title'] }}</h3>
                            <p class="text-sm leading-relaxed text-ink-400">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Mobile --}}
            <div class="lg:hidden">
                @foreach ($lifecycleSteps as $index => $step)
                    <div class="group reveal relative flex gap-5 {{ $index === $lastStep ? '' : 'pb-10' }}">
                        @unless ($index === $lastStep)
                            <span class="absolute bottom-0 left-7 top-14 w-0.5 -translate-x-1/2 bg-ink-100"></span>
                        @endunless

                        <div class="relative flex shrink-0 flex-col items-center">
                            <span class="relative z-10 flex h-14 w-14 items-center justify-center rounded-full border-2 border-accent-500 bg-white font-display text-lg font-bold text-accent-600 transition-all duration-300 group-hover:bg-accent-500 group-hover:text-white">{{ $step['num'] }}</span>
                            <div class="mt-4 flex h-12 w-12 items-center justify-center rounded-full bg-surface ring-1 ring-ink-100 transition-all duration-300 group-hover:bg-accent-500 group-hover:ring-accent-500">
                                <i class="fa-solid {{ $step['icon'] }} text-lg text-primary-600 transition-all duration-300 group-hover:text-white"></i>
                            </div>
                        </div>

                        <div class="pt-3">
                            <h3 class="mb-2 font-heading text-base font-bold leading-snug text-ink-900">{{ $step['title'] }}</h3>
                            <p class="text-sm leading-relaxed text-ink-400">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ CASE STUDIES ═══ --}}
    @if ($featuredCaseStudies->count())
        <section class="border-t border-ink-100 bg-white py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-16 flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                    <div class="reveal-left">
                        <p class="eyebrow mb-4">Our Work</p>
                        <h2 class="font-heading text-4xl text-ink-900 md:text-5xl">
                            Featured<br><span class="text-accent-600">Case Studies</span>
                        </h2>
                    </div>
                    <a href="{{ route('case-studies.index') }}" class="reveal-right group inline-flex shrink-0 items-center gap-2 font-semibold text-ink-800 transition-colors hover:text-accent-600">
                        All Case Studies
                        <x-icon name="arrow-long-right" class="h-5 w-5 arrow-nudge" />
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-7 md:grid-cols-3">
                    @foreach ($featuredCaseStudies as $index => $caseStudy)
                        @include('frontend.case-studies._card', ['cs' => $caseStudy, 'delay' => $index * 100])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ INDUSTRIES ═══ --}}
    @if ($industries->count())
        <section class="bg-surface py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="reveal mb-16 text-center">
                    <p class="eyebrow mb-4">Sectors</p>
                    <h2 class="mb-4 font-heading text-4xl text-ink-900 md:text-5xl">
                        Industries<br><span class="text-accent-600">We Serve</span>
                    </h2>
                </div>

                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    @foreach ($industries as $index => $industry)
                        @php
                            $iconName = $industry->icon ?: 'building';
                            $iconClass = \Illuminate\Support\Str::startsWith($iconName, 'fa-') ? $iconName : 'fa-'.$iconName;
                        @endphp
                        <a href="{{ route('industries.show', $industry->slug) }}"
                            class="wf-panel group reveal p-6 text-center"
                            style="transition-delay: {{ $index * 60 }}ms">
                            <div class="wf-chip mx-auto mb-3 flex h-12 w-12 items-center justify-center">
                                <i class="fa-solid {{ $iconClass }} text-xl"></i>
                            </div>
                            <h3 class="text-sm font-semibold text-white transition-colors group-hover:text-accent-300">{{ $industry->name }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ COMMITMENTS ═══ --}}
    <section class="relative overflow-hidden bg-primary-950 wf-texture py-24">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-950 via-primary-900/90 to-accent-950/40"></div>
        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-14 grid items-end gap-10 lg:grid-cols-2 lg:gap-16">
                <div class="reveal-left">
                    <p class="eyebrow eyebrow-light mb-4">How We Work</p>
                    <h2 class="font-heading text-4xl leading-tight text-white md:text-5xl">
                        Ownership Is Engineered<br><span class="text-accent-300">Into The Process.</span>
                    </h2>
                </div>
                <p class="reveal-right leading-relaxed text-primary-200">
                    Every engagement is held to the same commitments — technical creativity, regional awareness, direct
                    collaboration, confidentiality and cost-effective sustainability. They are how our work is judged,
                    from the first calculation to the last day of operations support.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-5">
                @foreach ([
                    ['light-bulb', 'Creative Delivery', 'Creatively deliver high-quality technical solutions.'],
                    ['map-pin', 'Regional Focus', 'Comprehensive approach with region-specific focus.'],
                    ['users', 'On-Site Collaboration', 'Close interaction with clients and project teams on site.'],
                    ['lock-closed', 'Ownership & Confidence', 'Maintain ownership and respect confidentiality.'],
                    ['scale', 'Sustainable Value', 'Cost-effective solutions integrating every stakeholder.'],
                ] as $index => [$icon, $title, $detail])
                    <div class="group reveal rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm transition-colors duration-300 hover:bg-white/10" style="transition-delay: {{ $index * 70 }}ms">
                        <div class="mb-5 flex items-center justify-between">
                            <span class="wf-chip flex h-11 w-11 items-center justify-center">
                                <x-icon name="{{ $icon }}" class="h-5 w-5" />
                            </span>
                            <span class="font-display text-xs font-semibold text-accent-300">0{{ $index + 1 }}</span>
                        </div>
                        <h3 class="mb-2 font-heading text-base font-semibold leading-snug text-white">{{ $title }}</h3>
                        <p class="text-sm leading-relaxed text-primary-200">{{ $detail }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ LATEST INSIGHTS ═══ --}}
    @if ($latestBlogs->count())
        <section class="bg-white py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-16 flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
                    <div class="reveal-left">
                        <p class="eyebrow mb-4">Knowledge</p>
                        <h2 class="font-heading text-4xl text-ink-900 md:text-5xl">
                            Latest<br><span class="text-accent-600">Insights</span>
                        </h2>
                    </div>
                    <a href="{{ route('insights.index') }}" class="reveal-right group inline-flex shrink-0 items-center gap-2 font-semibold text-ink-800 transition-colors hover:text-accent-600">
                        All Articles
                        <x-icon name="arrow-long-right" class="h-5 w-5 arrow-nudge" />
                    </a>
                </div>
                <div class="grid grid-cols-1 gap-7 md:grid-cols-3">
                    @foreach ($latestBlogs as $index => $blog)
                        @include('frontend.insights._card', ['blog' => $blog, 'delay' => $index * 100])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ SOFTWARE ═══ --}}
    @if ($softwareSection['enabled'] && $softwareLogos->count())
        <section class="border-t border-ink-100 bg-white py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="reveal mb-10 text-center">
                    @if ($softwareSection['eyebrow'])
                        <p class="eyebrow mb-4">{{ $softwareSection['eyebrow'] }}</p>
                    @endif
                    <h2 class="font-heading text-3xl font-bold text-ink-900 md:text-4xl">
                        {{ $softwareSection['heading'] }}
                        @if ($softwareSection['heading_accent'])
                            <span class="text-accent-600">{{ $softwareSection['heading_accent'] }}</span>
                        @endif
                    </h2>
                    @if ($softwareSection['subtitle'])
                        <p class="mx-auto mt-4 max-w-2xl leading-relaxed text-ink-500">{{ $softwareSection['subtitle'] }}</p>
                    @endif
                </div>
                <div class="reveal flex flex-wrap items-center justify-center gap-8 md:gap-12">
                    @foreach ($softwareLogos as $logo)
                        <div class="flex h-14 items-center justify-center">
                            @if ($logo->path)
                                <img src="{{ asset($logo->path) }}" alt="{{ $logo->name ?? 'Software' }}" title="{{ $logo->name ?? '' }}"
                                    class="max-h-full w-auto object-contain opacity-90 transition-all duration-300 hover:opacity-100" loading="lazy">
                            @else
                                <span class="text-sm font-semibold uppercase tracking-wide text-ink-400">{{ $logo->name }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ CTA ═══ --}}
    <section class="relative overflow-hidden bg-surface wf-texture wf-texture-light py-28">
        <div class="pointer-events-none absolute -right-24 bottom-0 h-[28rem] w-[28rem] opacity-40" aria-hidden="true">
            @foreach ([0, 30, 60, 90, 120, 150] as $inset)
                <div class="absolute inset-0 rounded-full border border-accent-200" style="margin: {{ $inset }}px"></div>
            @endforeach
        </div>

        <div class="relative z-10 mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <div class="reveal">
                <p class="eyebrow mb-5">Start a Conversation</p>
                <h2 class="mb-6 font-heading text-4xl text-ink-900 md:text-6xl">
                    Ready to Solve<br><span class="text-accent-600">Something Difficult?</span>
                </h2>
                <p class="mx-auto mb-10 max-w-2xl text-lg text-ink-400">
                    From feasibility to final delivery — tell us about your project and our engineering team will
                    develop the solution.
                </p>
                <div class="flex flex-col items-center justify-center gap-4 sm:flex-row">
                    <a href="{{ route('contact') }}" class="wf-btn-primary group px-10 py-4 text-lg">
                        Get in Touch
                        <x-icon name="arrow-long-right" class="h-5 w-5 arrow-nudge" />
                    </a>
                    <a href="{{ route('expertise.index') }}" class="wf-btn-outline px-8 py-4">
                        Our Expertise
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        (() => {
            const heroVideo = document.querySelector('[data-hero-video]');
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

            if (!heroVideo) {
                return;
            }

            const syncHeroMotion = () => {
                if (reducedMotion.matches) {
                    heroVideo.pause();

                    return;
                }

                heroVideo.play().catch(() => {});
            };

            syncHeroMotion();
            reducedMotion.addEventListener?.('change', syncHeroMotion);
        })();
    </script>
@endpush
