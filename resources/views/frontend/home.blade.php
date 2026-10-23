@extends('layouts.app')

@section('content')
    {{-- ═══ HERO ═══ --}}
    <section class="border-b border-line bg-surface">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 pb-14 pt-12 sm:px-6 lg:grid-cols-12 lg:gap-10 lg:px-8 lg:pb-16 lg:pt-16">
            <div class="flex flex-col justify-center lg:col-span-6">
                <p class="reveal eyebrow">{{ $settings->get('site_tagline', 'Engineering Water, Sustainably') }}</p>

                <h1 class="reveal delay-100 mt-7 text-[clamp(2.6rem,5.4vw,4.9rem)] text-ink-900">
                    Engineering clarity for <span class="text-primary-600">every drop.</span>
                </h1>

                <p class="reveal delay-200 mt-7 max-w-xl text-lg leading-8 text-ink-600">
                    A multi-disciplinary engineering and infrastructure consultancy delivering water-led, high-performance
                    solutions across every phase of the project lifecycle.
                </p>

                <div class="reveal delay-300 mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('expertise.index') }}" class="wf-btn-primary group px-6 py-3.5">
                        Explore expertise
                        <x-icon name="arrow-long-right" class="arrow-nudge h-5 w-5" />
                    </a>
                    <a href="{{ route('case-studies.index') }}" class="wf-btn-outline px-6 py-3.5">View case studies</a>
                </div>
            </div>

            <div class="reveal-right lg:col-span-6">
                <div class="flex h-[380px] gap-4 sm:h-[480px] lg:h-[540px]">
                    {{-- Staff gauge: the measuring scale beside the water --}}
                    <div class="relative hidden w-14 shrink-0 sm:block" aria-hidden="true">
                        <div class="gauge-y absolute inset-y-0 right-0"></div>
                        <div class="absolute inset-y-0 right-5 flex flex-col justify-between py-0 text-right font-mono text-[10px] leading-none text-ink-400">
                            @foreach (['5.0', '4.0', '3.0', '2.0', '1.0', '0.0'] as $mark)
                                <span>{{ $mark }}</span>
                            @endforeach
                        </div>
                        <div class="water-level absolute right-0 top-[38%] flex items-center gap-1.5">
                            <span class="font-mono text-[10px] font-semibold text-accent-700">WL</span>
                            <span class="h-0 w-0 border-y-[5px] border-r-[8px] border-y-transparent border-r-accent-500"></span>
                        </div>
                    </div>

                    <div class="relative flex-1 overflow-hidden rounded bg-primary-950">
                        <video
                            data-hero-video
                            class="h-full w-full object-cover"
                            poster="{{ asset('images/waterfirst-hero-poster.jpg') }}"
                            autoplay muted loop playsinline preload="metadata"
                            aria-hidden="true" tabindex="-1" disablepictureinpicture
                        >
                            <source src="{{ $heroVideo?->url ?? asset('videos/hero-water-treatment.mp4') }}">
                        </video>
                        <span class="pointer-events-none absolute inset-x-0 top-[38%] border-t border-dashed border-accent-300/80" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Key figures --}}
        <div id="site-metrics" class="border-t border-line bg-white">
            <div class="mx-auto grid max-w-7xl grid-cols-2 px-4 sm:px-6 lg:grid-cols-4 lg:px-8">
                @foreach ([
                    ['20', '+', 20, 'Years founder experience'],
                    ['15–35', '', null, 'Years per discipline'],
                    [$expertiseServices->count(), '', $expertiseServices->count(), 'Engineering disciplines'],
                    ['2000', '+', 2000, 'Projects delivered'],
                ] as $index => [$value, $suffix, $countTo, $label])
                    <div class="reveal border-line py-8 {{ $index % 2 ? 'pl-6' : 'pr-6' }} {{ $index % 2 === 0 ? 'border-r' : '' }} {{ $index > 1 ? 'border-t lg:border-t-0' : '' }} lg:border-r lg:px-8 lg:first:pl-0 lg:last:border-r-0 {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }}">
                        <p class="metric text-4xl font-semibold md:text-5xl">
                            @if ($countTo)
                                <span data-count-to="{{ $countTo }}" data-count-suffix="{{ $suffix }}">{{ $value }}{{ $suffix }}</span>
                            @else
                                {{ $value }}{{ $suffix }}
                            @endif
                        </p>
                        <p class="mt-3 text-sm text-ink-600">{{ $label }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ WHO WE ARE ═══ --}}
    <section class="bg-white py-20 md:py-28">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <div class="reveal-left lg:col-span-5">
                <p class="eyebrow">Who we are</p>
                <h2 class="mt-6 text-4xl leading-tight text-ink-900 md:text-5xl">Engineering water systems for sustainable communities.</h2>
            </div>

            <div class="lg:col-span-7">
                <div class="reveal space-y-5 text-lg leading-8 text-ink-600">
                    <p>WaterFirst is a leading engineering consultancy providing specialized services across water, wastewater, environmental, and infrastructure sectors. Our expertise spans the entire asset lifecycle, from strategic planning and feasibility assessment to detailed engineering, construction support, and ongoing operational services.</p>
                    <p>By integrating technical innovation, industry best practices, and client-focused delivery, we create solutions that enhance operational efficiency, ensure regulatory compliance, and deliver measurable long-term value.</p>
                </div>

                <div class="mt-12 grid gap-x-10 gap-y-8 sm:grid-cols-2">
                    @foreach ([
                        ['light-bulb', 'Advanced technical capabilities', 'Practical and innovative engineering solutions tailored to project-specific challenges.'],
                        ['globe-alt', 'Environmentally responsible design', 'Engineering outcomes that balance performance, sustainability, and environmental stewardship.'],
                        ['users', 'Client-centric project delivery', 'Transparent collaboration and stakeholder engagement throughout all project phases.'],
                        ['scale', 'Optimized whole-of-life value', 'Cost-effective infrastructure that supports reliability, resilience, and long-term asset performance.'],
                    ] as $index => [$icon, $title, $detail])
                        <div class="reveal border-t-2 border-ink-900 pt-5 {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }}">
                            <x-icon name="{{ $icon }}" class="h-6 w-6 text-primary-600" />
                            <h3 class="mt-4 text-lg font-semibold text-ink-900">{{ $title }}</h3>
                            <p class="mt-2 text-sm leading-6 text-ink-600">{{ $detail }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ EXPERTISE ═══ --}}
    @if ($featuredServices->count())
        <section class="border-y border-line bg-surface py-20 md:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <div class="reveal-left max-w-2xl">
                        <p class="eyebrow">What we do</p>
                        <h2 class="mt-6 text-4xl leading-tight text-ink-900 md:text-5xl">Multi-disciplinary engineering, built around water.</h2>
                    </div>
                    <a href="{{ route('expertise.index') }}" class="reveal-right group inline-flex shrink-0 items-center gap-2 font-semibold text-primary-600">
                        All {{ $expertiseServices->count() }} disciplines <x-icon name="arrow-long-right" class="arrow-nudge h-5 w-5" />
                    </a>
                </div>

                <div class="mt-14 border-b border-line">
                    @foreach ($featuredServices as $index => $service)
                        <a href="{{ route('expertise.show', $service->slug) }}"
                            class="group reveal grid items-center gap-5 border-t border-line py-6 md:grid-cols-[200px_minmax(0,1fr)_minmax(0,1.15fr)_auto] md:gap-8"
                            style="transition-delay: {{ $index * 60 }}ms">
                            <div class="media-frame hidden aspect-[3/2] rounded md:block">
                                @if ($service->featured_image)
                                    <img src="{{ asset($service->featured_image) }}" alt="" loading="lazy" decoding="async" class="h-full w-full object-cover">
                                @endif
                            </div>
                            <h3 class="flex items-center gap-3 text-xl font-semibold leading-snug text-ink-900 transition-colors group-hover:text-primary-600 md:text-2xl">
                                <span class="shrink-0 text-accent-600 md:hidden"><x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-5 w-5" /></span>
                                {{ $service->name }}
                            </h3>
                            <p class="text-sm leading-6 text-ink-600 md:text-base md:leading-7">{{ $service->short_description }}</p>
                            <span class="hidden h-12 w-12 items-center justify-center rounded border border-ink-200 text-ink-800 transition-colors group-hover:border-primary-600 group-hover:bg-primary-600 group-hover:text-white md:flex">
                                <x-icon name="arrow-long-right" class="h-5 w-5" />
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ PROJECT LIFECYCLE ═══ --}}
    <section class="bg-white py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-12 lg:items-end">
                <div class="reveal-left lg:col-span-6">
                    <p class="eyebrow">Our involvement</p>
                    <h2 class="mt-6 text-4xl leading-tight text-ink-900 md:text-5xl">One team from feasibility to operations.</h2>
                </div>
                <p class="reveal-right text-base leading-7 text-ink-600 lg:col-span-5 lg:col-start-8">
                    {{ $settings->get('site_name', 'WaterFirst') }} supports its partners at every stage — from early
                    planning and feasibility through detailed design, construction and handover. Backed by rigorous
                    engineering and digital workflows, we deliver accurate deliverables and practical solutions that keep
                    projects moving forward.
                </p>
            </div>

            @php
                $lifecycleSteps = [
                    ['fa-clipboard-list', 'Feasibility & Tendering', 'Options studies, BOQs, conceptual design and bid support.'],
                    ['fa-compass-drafting', 'Preliminary Design', 'Project setup, workflows, process selection and preliminary engineering.'],
                    ['fa-cube', 'Detailed Design', 'Detailed engineering, coordination, IFC drawings and BIM models.'],
                    ['fa-helmet-safety', 'Construction', 'Temporary works, quantities, utility coordination and RFI support.'],
                    ['fa-handshake', 'Handover', 'As-built documentation, consolidated RFIs and coordinated models.'],
                    ['fa-gears', 'Operations & Maintenance', 'Asset registers, optimisation and updated lifecycle data.'],
                ];
                $lastStep = count($lifecycleSteps) - 1;
            @endphp

            <ol class="relative mt-16 grid gap-y-10 lg:grid-cols-6">
                <svg class="pointer-events-none absolute inset-x-0 top-[21px] hidden h-1 w-full text-accent-500 lg:block" viewBox="0 0 1000 4" preserveAspectRatio="none" aria-hidden="true">
                    <path d="M0 2H1000" stroke="#C9DEE9" stroke-width="2"/>
                    <path class="flow-stroke" d="M0 2H1000" stroke="currentColor" stroke-width="2"/>
                </svg>

                @foreach ($lifecycleSteps as $index => [$icon, $title, $detail])
                    <li class="group reveal relative pl-16 lg:pl-0 lg:pr-6" style="transition-delay: {{ $index * 80 }}ms">
                        @unless ($index === $lastStep)
                            <span class="absolute -bottom-10 left-[21px] top-11 w-0.5 bg-ink-200 lg:hidden" aria-hidden="true"></span>
                        @endunless
                        <span class="absolute left-0 top-0 flex h-11 w-11 items-center justify-center rounded border border-ink-200 bg-white text-primary-600 transition-colors group-hover:border-primary-600 group-hover:bg-primary-600 group-hover:text-white lg:relative">
                            <i class="fa-solid {{ $icon }}"></i>
                        </span>
                        <p class="font-mono text-xs font-medium text-accent-700 lg:mt-6">Stage {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</p>
                        <h3 class="mt-2 text-base font-semibold leading-snug text-ink-900">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-6 text-ink-600">{{ $detail }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ═══ PROJECT FOOTPRINT ═══ --}}
    <section class="border-t border-line bg-white py-20 md:py-28">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:items-center lg:px-8">
            <div class="reveal-left lg:col-span-4">
                <p class="eyebrow">Project footprint</p>
                <h2 class="mt-6 text-4xl leading-tight text-ink-900 md:text-5xl">Infrastructure. Industry. Environment.</h2>
                <p class="mt-6 text-base leading-7 text-ink-600">
                    WaterFirst has built a strong footprint across regions spanning the infrastructure and industrial
                    sectors. We continue to expand our capabilities and partnerships to deliver sustainable, compliant
                    solutions in a rapidly evolving environment.
                </p>
            </div>
            <figure class="reveal-scale rounded border border-line bg-white p-3 lg:col-span-8">
                <img src="{{ asset('images/mapimages.jpg') }}" alt="Map of global project footprint across infrastructure and industry" loading="lazy"
                    class="h-auto w-full select-none rounded-sm">
            </figure>
        </div>
    </section>

    {{-- ═══ CASE STUDIES ═══ --}}
    @if ($featuredCaseStudies->count())
        @php
            $leadCaseStudy = $featuredCaseStudies->first();
            $otherCaseStudies = $featuredCaseStudies->slice(1);
        @endphp
        <section class="border-t border-line bg-surface py-20 md:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <div class="reveal-left max-w-2xl">
                        <p class="eyebrow">Our work</p>
                        <h2 class="mt-6 text-4xl leading-tight text-ink-900 md:text-5xl">Featured case studies</h2>
                    </div>
                    <a href="{{ route('case-studies.index') }}" class="reveal-right group inline-flex shrink-0 items-center gap-2 font-semibold text-primary-600">
                        All case studies <x-icon name="arrow-long-right" class="arrow-nudge h-5 w-5" />
                    </a>
                </div>

                <div class="mt-14 grid gap-8 lg:grid-cols-12">
                    <a href="{{ route('case-studies.show', $leadCaseStudy->slug) }}" class="group reveal lg:col-span-7">
                        <div class="media-frame aspect-[16/10] rounded">
                            @if ($leadCaseStudy->featured_image)
                                <img src="{{ asset($leadCaseStudy->featured_image) }}" alt="{{ $leadCaseStudy->title }}" loading="lazy" decoding="async" class="h-full w-full object-cover">
                            @endif
                        </div>
                        <p class="mt-6 font-mono text-xs uppercase tracking-[.12em] text-accent-700">
                            {{ collect([$leadCaseStudy->industry?->name, $leadCaseStudy->category?->name])->filter()->implode(' / ') }}
                        </p>
                        <h3 class="mt-3 text-2xl font-semibold leading-snug text-ink-900 md:text-3xl">
                            <span class="underline-grow">{{ $leadCaseStudy->title }}</span>
                        </h3>
                    </a>

                    <div class="lg:col-span-5">
                        @foreach ($otherCaseStudies as $index => $caseStudy)
                            <a href="{{ route('case-studies.show', $caseStudy->slug) }}"
                                class="group reveal grid grid-cols-[120px_1fr] gap-5 border-line py-6 first:pt-0 sm:grid-cols-[160px_1fr] {{ $loop->last ? '' : 'border-b' }}"
                                style="transition-delay: {{ ($index + 1) * 100 }}ms">
                                <div class="media-frame aspect-[4/3] rounded">
                                    @if ($caseStudy->featured_image)
                                        <img src="{{ asset($caseStudy->featured_image) }}" alt="" loading="lazy" decoding="async" class="h-full w-full object-cover">
                                    @endif
                                </div>
                                <div>
                                    <p class="font-mono text-[11px] uppercase tracking-[.12em] text-accent-700">{{ $caseStudy->industry?->name }}</p>
                                    <h3 class="mt-2 text-lg font-semibold leading-snug text-ink-900">
                                        <span class="underline-grow">{{ $caseStudy->title }}</span>
                                    </h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ INDUSTRIES ═══ --}}
    @if ($industries->count())
        <section class="border-t border-line bg-white py-20 md:py-28">
            <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
                <div class="reveal-left lg:col-span-4">
                    <p class="eyebrow">Sectors</p>
                    <h2 class="mt-6 text-4xl leading-tight text-ink-900 md:text-5xl">Industries we serve</h2>
                </div>

                <ul class="grid border-t border-line sm:grid-cols-2 lg:col-span-8">
                    @foreach ($industries as $index => $industry)
                        @php
                            $iconName = $industry->icon ?: 'building';
                            $iconClass = \Illuminate\Support\Str::startsWith($iconName, 'fa-') ? $iconName : 'fa-'.$iconName;
                        @endphp
                        <li class="reveal border-b border-line {{ $index % 2 === 0 ? 'sm:border-r sm:pr-8' : 'sm:pl-8' }}" style="transition-delay: {{ ($index % 4) * 60 }}ms">
                            <a href="{{ route('industries.show', $industry->slug) }}" class="group flex items-center gap-5 py-5">
                                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded bg-surface text-lg text-primary-600 transition-colors group-hover:bg-primary-600 group-hover:text-white">
                                    <i class="fa-solid {{ $iconClass }}"></i>
                                </span>
                                <span class="flex-1 text-base font-semibold text-ink-900">{{ $industry->name }}</span>
                                <x-icon name="arrow-long-right" class="h-4 w-4 text-ink-300 transition-colors group-hover:text-primary-600" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    {{-- ═══ COMMITMENTS ═══ --}}
    <section class="border-t border-line bg-surface py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-12 lg:items-end">
                <div class="reveal-left lg:col-span-6">
                    <p class="eyebrow">How we work</p>
                    <h2 class="mt-6 text-4xl leading-tight text-ink-900 md:text-5xl">Ownership is engineered into the process.</h2>
                </div>
                <p class="reveal-right text-base leading-7 text-ink-600 lg:col-span-5 lg:col-start-8">
                    Every engagement is held to the same commitments — technical creativity, regional awareness, direct
                    collaboration, confidentiality and cost-effective sustainability.
                </p>
            </div>

            <div class="mt-14 grid border-t border-ink-200 md:grid-cols-2 lg:grid-cols-5">
                @foreach ([
                    ['light-bulb', 'Creative delivery', 'Creatively deliver high-quality technical solutions.'],
                    ['map-pin', 'Regional focus', 'Comprehensive approach with region-specific focus.'],
                    ['users', 'On-site collaboration', 'Close interaction with clients and project teams on site.'],
                    ['lock-closed', 'Ownership & confidence', 'Maintain ownership and respect confidentiality.'],
                    ['scale', 'Sustainable value', 'Cost-effective solutions integrating every stakeholder.'],
                ] as $index => [$icon, $title, $detail])
                    <div class="reveal border-b border-ink-200 py-8 md:pr-6 lg:border-b-0 lg:border-r lg:px-6 lg:first:pl-0 lg:last:border-r-0" style="transition-delay: {{ $index * 70 }}ms">
                        <x-icon name="{{ $icon }}" class="h-6 w-6 text-primary-600" />
                        <h3 class="mt-5 text-base font-semibold text-ink-900">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-6 text-ink-600">{{ $detail }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ LATEST INSIGHTS ═══ --}}
    @if ($latestBlogs->count())
        <section class="border-t border-line bg-white py-20 md:py-28">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                    <div class="reveal-left">
                        <p class="eyebrow">Knowledge</p>
                        <h2 class="mt-6 text-4xl leading-tight text-ink-900 md:text-5xl">Latest insights</h2>
                    </div>
                    <a href="{{ route('insights.index') }}" class="reveal-right group inline-flex shrink-0 items-center gap-2 font-semibold text-primary-600">
                        All articles <x-icon name="arrow-long-right" class="arrow-nudge h-5 w-5" />
                    </a>
                </div>

                <div class="mt-14 border-b border-line">
                    @foreach ($latestBlogs as $index => $blog)
                        <a href="{{ route('insights.show', $blog->slug) }}"
                            class="group reveal grid gap-4 border-t border-line py-7 md:grid-cols-[160px_minmax(0,1fr)_200px] md:items-center md:gap-10"
                            style="transition-delay: {{ $index * 80 }}ms">
                            <p class="font-mono text-xs text-ink-500">
                                {{ $blog->published_at?->format('d M Y') }}
                                <span class="mt-1 block text-accent-700">{{ $blog->reading_time }} min read</span>
                            </p>
                            <div>
                                @if ($blog->category)
                                    <p class="font-mono text-[11px] uppercase tracking-[.12em] text-primary-600">{{ $blog->category->name }}</p>
                                @endif
                                <h3 class="mt-2 text-xl font-semibold leading-snug text-ink-900 md:text-2xl">
                                    <span class="underline-grow">{{ $blog->title }}</span>
                                </h3>
                            </div>
                            <div class="media-frame hidden aspect-[16/10] rounded md:block">
                                @if ($blog->featured_image)
                                    <img src="{{ asset($blog->featured_image) }}" alt="" loading="lazy" decoding="async" class="h-full w-full object-cover">
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ SOFTWARE ═══ --}}
    @if ($softwareSection['enabled'] && $softwareLogos->count())
        <section class="border-t border-line bg-white py-16 md:py-20">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:items-center lg:px-8">
                <div class="reveal-left lg:col-span-4">
                    @if ($softwareSection['eyebrow'])
                        <p class="eyebrow">{{ $softwareSection['eyebrow'] }}</p>
                    @endif
                    <h2 class="mt-6 text-3xl leading-tight text-ink-900 md:text-4xl">
                        {{ $softwareSection['heading'] }}
                        @if ($softwareSection['heading_accent'])
                            <span class="text-primary-600">{{ $softwareSection['heading_accent'] }}</span>
                        @endif
                    </h2>
                    @if ($softwareSection['subtitle'])
                        <p class="mt-5 text-base leading-7 text-ink-600">{{ $softwareSection['subtitle'] }}</p>
                    @endif
                </div>
                <div class="reveal grid grid-cols-2 border-l border-t border-line sm:grid-cols-3 lg:col-span-8 xl:grid-cols-5">
                    @foreach ($softwareLogos as $logo)
                        <div class="flex h-24 items-center justify-center border-b border-r border-line p-5">
                            @if ($logo->path)
                                <img src="{{ asset($logo->path) }}" alt="{{ $logo->name ?? 'Software' }}" title="{{ $logo->name ?? '' }}" loading="lazy"
                                    class="max-h-full w-auto object-contain">
                            @else
                                <span class="font-mono text-xs uppercase tracking-wide text-ink-500">{{ $logo->name }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ═══ CTA ═══ --}}
    <section class="flow-lines bg-primary-600 py-20 text-white md:py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:items-end lg:px-8">
            <div class="reveal-left lg:col-span-7">
                <p class="eyebrow eyebrow-light">Start a conversation</p>
                <h2 class="mt-6 text-4xl leading-tight text-white md:text-6xl">Ready to solve something difficult?</h2>
                <p class="mt-6 max-w-xl text-lg leading-8 text-primary-100">
                    From feasibility to final delivery — tell us about your project and our engineering team will develop the solution.
                </p>
            </div>
            <div class="reveal-right flex flex-col gap-3 sm:flex-row lg:col-span-5 lg:justify-end">
                <a href="{{ route('contact') }}" class="wf-btn-light group px-6 py-3.5">
                    Start a project <x-icon name="arrow-long-right" class="arrow-nudge h-5 w-5" />
                </a>
                <a href="{{ route('expertise.index') }}" class="wf-btn-outline wf-btn-outline-light px-6 py-3.5">Our expertise</a>
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
