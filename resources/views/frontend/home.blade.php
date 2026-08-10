@extends('layouts.app')

@section('content')
    <section class="relative isolate overflow-hidden bg-primary-950 text-white">
        <video
            data-hero-video
            class="absolute inset-0 h-full w-full object-cover"
            poster="{{ asset('images/waterfirst-hero-poster.jpg') }}"
            autoplay
            muted
            loop
            playsinline
            preload="metadata"
            aria-hidden="true"
            tabindex="-1"
            disablepictureinpicture
        >
            <source src="{{ asset('videos/hero-water-treatment.mp4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-primary-950/60"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary-950 via-primary-900/80 to-primary-950/20"></div>

        <svg class="pointer-events-none absolute inset-x-0 bottom-0 h-24 w-full text-accent-400/25" viewBox="0 0 1440 120" preserveAspectRatio="none" aria-hidden="true" fill="none">
            <path class="flow-stroke" stroke="currentColor" stroke-width="1.5" d="M0 74c160-40 260 34 420 6s250-56 400-24 300 62 420 26 200-30 200-30"/>
            <path class="flow-stroke-slow" stroke="currentColor" stroke-width="1.5" d="M0 100c170-38 250 30 430 4s240-52 396-20 306 58 414 24 200-26 200-26"/>
        </svg>

        <div class="relative z-10 mx-auto grid min-h-[720px] max-w-7xl items-center gap-14 px-4 py-20 sm:px-6 lg:grid-cols-12 lg:px-8 lg:py-24">
            <div class="relative z-10 lg:col-span-7">
                <p class="section-kicker section-kicker-light reveal">01 — Water-led engineering</p>
                <h1 class="reveal delay-100 mt-8 max-w-4xl text-5xl font-semibold leading-[1.02] text-white md:text-7xl">
                    Engineering clarity for every drop.
                </h1>
                <p class="reveal delay-200 mt-8 max-w-2xl text-lg leading-8 text-primary-100 md:text-xl">
                    Sustainable technical solutions for municipal and industrial water, wastewater and environmental infrastructure — designed in Bangalore, delivered with ownership.
                </p>
                <div class="reveal delay-300 mt-10 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('expertise.index') }}" class="wf-btn-light sheen group">
                        Explore water engineering
                        <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                    </a>
                    <a href="{{ route('case-studies.index') }}" class="wf-btn-outline border-accent-300 text-white hover:bg-primary-700">
                        View project record
                    </a>
                </div>

                <div class="reveal delay-400 mt-12 flex flex-wrap gap-x-8 gap-y-4 border-t border-primary-500/70 pt-7">
                    @foreach ([
                        ['building-library', 'Municipal programmes'],
                        ['beaker', 'Industrial effluent'],
                        ['arrow-path', 'Reuse & recycling'],
                        ['wrench-screwdriver', 'Design to O&M'],
                    ] as [$icon, $label])
                        <span class="group flex items-center gap-3">
                            <span class="icon-tile icon-tile-dark h-9 w-9"><x-icon name="{{ $icon }}" class="h-4 w-4" /></span>
                            <span class="font-mono text-[10px] uppercase tracking-[.16em] text-primary-100">{{ $label }}</span>
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="reveal-scale lg:col-span-5">
                <div class="border border-primary-300/60 bg-primary-950/75 p-6 shadow-2xl backdrop-blur-sm md:p-8">
                    <div class="flex items-center justify-between border-b border-primary-500 pb-4">
                        <span class="font-mono text-[10px] uppercase tracking-[.18em] text-accent-200">Treatment train / 01</span>
                        <span class="flex items-center gap-2">
                            <span class="pulse-node h-1.5 w-1.5 rounded-full bg-accent-400"></span>
                            <span class="font-mono text-[9px] uppercase tracking-[.16em] text-primary-200">Live schematic</span>
                        </span>
                    </div>

                    <svg viewBox="0 0 440 236" class="mt-6 w-full" role="img" aria-label="Animated schematic showing water moving from intake through the treatment process to reuse">
                        <defs>
                            <clipPath id="wf-intake-clip"><rect x="88" y="98" width="52" height="84"/></clipPath>
                            <clipPath id="wf-reuse-clip"><rect x="332" y="98" width="52" height="84"/></clipPath>
                        </defs>

                        <g stroke="#1686C4" stroke-opacity=".35" stroke-width=".75">
                            <path d="M0 62h440M0 218h440M62 30v186M404 30v186"/>
                        </g>

                        <g stroke="#7CC6F4" stroke-opacity=".4" stroke-width="3" stroke-linecap="round">
                            <path d="M16 140h72M140 140h52M280 140h52M384 140h40"/>
                        </g>
                        <g stroke="#67E5E5" stroke-width="3" stroke-linecap="round" fill="none">
                            <path class="flow-stroke" d="M16 140h72"/>
                            <path class="flow-stroke" style="animation-delay:.4s" d="M140 140h52"/>
                            <path class="flow-stroke" style="animation-delay:.8s" d="M280 140h52"/>
                            <path class="flow-stroke" style="animation-delay:1.2s" d="M384 140h40"/>
                        </g>

                        <rect x="88" y="98" width="52" height="84" fill="#072139" stroke="#00A6A6" stroke-width="1.75"/>
                        <g clip-path="url(#wf-intake-clip)">
                            <path class="float-slow" d="M74 148c11-9 22-9 33 0s22 9 33 0 22-9 33 0v52H74z" fill="#00A6A6" fill-opacity=".38"/>
                        </g>
                        <g stroke="#D9EEFF" stroke-opacity=".5" stroke-width="1">
                            <path d="M97 108h34M97 118h34M97 128h34"/>
                        </g>

                        <circle class="spin-ring" cx="236" cy="140" r="55" fill="none" stroke="#67E5E5" stroke-opacity=".45" stroke-width="1.25" stroke-dasharray="5 13"/>
                        <circle cx="236" cy="140" r="44" fill="#07579A" fill-opacity=".45" stroke="#00A6A6" stroke-width="1.75"/>
                        <g stroke="#A5F3F3" stroke-opacity=".75" stroke-width="1.15">
                            <path d="M204 140h64M236 108v64"/>
                        </g>
                        <circle class="pulse-node" cx="236" cy="140" r="6" fill="#00A6A6"/>

                        <rect x="332" y="98" width="52" height="84" fill="#072139" stroke="#00A6A6" stroke-width="1.75"/>
                        <g clip-path="url(#wf-reuse-clip)">
                            <path class="float-slow" style="animation-delay:1.1s" d="M318 156c11-9 22-9 33 0s22 9 33 0 22-9 33 0v46h-99z" fill="#00A6A6" fill-opacity=".32"/>
                        </g>
                        <path d="M358 110c6.4 7.9 11 13.7 11 19a11 11 0 0 1-22 0c0-5.3 4.6-11.1 11-19z" fill="none" stroke="#A5F3F3" stroke-opacity=".85" stroke-width="1.4"/>

                        <g fill="#67E5E5">
                            <circle class="pulse-node" cx="52" cy="140" r="3.5"/>
                            <circle class="pulse-node" style="animation-delay:.7s" cx="166" cy="140" r="3.5"/>
                            <circle class="pulse-node" style="animation-delay:1.4s" cx="306" cy="140" r="3.5"/>
                            <circle class="pulse-node" style="animation-delay:2.1s" cx="404" cy="140" r="3.5"/>
                        </g>

                        <g fill="#FFFFFF" font-family="IBM Plex Mono,monospace" font-size="10" text-anchor="middle">
                            <text x="114" y="206">INTAKE</text><text x="236" y="206">PROCESS</text><text x="358" y="206">REUSE</text>
                        </g>
                        <g fill="#00A6A6">
                            <rect x="104" y="214" width="20" height="2"/><rect x="226" y="214" width="20" height="2"/><rect x="348" y="214" width="20" height="2"/>
                        </g>
                    </svg>

                    <div class="grid grid-cols-3 border-t border-primary-500 pt-5 text-center">
                        @foreach ([
                            ['clock', '15–35', 'YEARS EXP.', null],
                            ['squares-2x2', '12', 'EXPERTISE AREAS', 12],
                            ['arrow-path', '360°', 'LIFECYCLE', null],
                        ] as [$icon, $value, $label, $countTo])
                            <div class="border-r border-primary-500 last:border-0">
                                <x-icon name="{{ $icon }}" class="mx-auto h-4 w-4 text-accent-300" />
                                <p class="mt-2 font-mono text-xl font-semibold text-white">
                                    @if ($countTo)
                                        <span data-count-to="{{ $countTo }}">{{ $value }}</span>
                                    @else
                                        {{ $value }}
                                    @endif
                                </p>
                                <p class="mt-1 font-mono text-[8px] tracking-[.14em] text-primary-200">{{ $label }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <a href="#site-metrics" class="absolute inset-x-0 bottom-6 z-10 mx-auto hidden w-max flex-col items-center gap-2 text-primary-100 hover:text-white lg:flex" aria-label="Scroll to key figures">
            <span class="font-mono text-[9px] uppercase tracking-[.2em]">Scroll</span>
            <x-icon name="chevron-down" class="scroll-cue h-4 w-4" />
        </a>
    </section>

    <section id="site-metrics" class="border-b border-ink-200 bg-white">
        <div class="mx-auto grid max-w-7xl grid-cols-2 px-4 sm:px-6 md:grid-cols-4 lg:px-8">
            @foreach ([
                ['academic-cap', '19', '', 'Years founder experience'],
                ['waves', '80', ' MLD', 'Largest listed sewer package'],
                ['wrench-screwdriver', '15', ' YRS', 'Long-term O&M scope'],
                ['shield-check', '5', '', 'Why WaterFirst pillars'],
            ] as $index => [$icon, $value, $unit, $label])
                <div class="group border-r border-ink-200 px-4 py-8 last:border-r-0 md:px-7 reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }}">
                    <span class="icon-tile h-10 w-10"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                    <p class="metric mt-5 text-2xl font-semibold md:text-3xl"><span data-count-to="{{ $value }}">{{ $value }}</span>{{ $unit }}</p>
                    <p class="mt-2 text-xs leading-5 text-ink-500">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </section>

    @if ($featuredServices->count())
        <section class="bg-surface py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-10 lg:grid-cols-12">
                    <div class="lg:col-span-3">
                        <div class="sticky-label">
                            <p class="section-kicker">02 — Expertise</p>
                            <h2 class="mt-6 text-3xl font-semibold leading-tight text-ink-800">Integrated around water. Exact at every stage.</h2>
                            <a href="{{ route('expertise.index') }}" class="group mt-7 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-secondary-500">
                                All 12 expertise areas <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                            </a>
                        </div>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2 lg:col-span-9">
                        @foreach ($featuredServices as $index => $service)
                            <a href="{{ route('expertise.show', $service->slug) }}" class="wf-card group flex flex-col overflow-hidden reveal {{ $index % 2 ? 'delay-100' : '' }}">
                                <div class="media-frame relative aspect-[16/9] w-full border-b border-ink-200">
                                    @if ($service->featured_image)
                                        <img
                                            src="{{ asset($service->featured_image) }}"
                                            alt="{{ $service->name }}"
                                            class="h-full w-full object-cover"
                                            loading="lazy"
                                            decoding="async"
                                        >
                                    @else
                                        <div class="flow-lines h-full w-full bg-primary-900"></div>
                                    @endif
                                    <div class="media-tint absolute inset-0"></div>
                                    <div class="media-veil absolute inset-x-0 bottom-0 h-2/3"></div>
                                    <span class="absolute right-4 top-4 font-mono text-xs font-semibold tracking-[.12em] text-accent-200">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="icon-tile icon-tile-dark absolute bottom-4 left-4 h-11 w-11 backdrop-blur-sm">
                                        <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-5 w-5" />
                                    </span>
                                </div>
                                <div class="flex flex-1 flex-col p-7">
                                    <h3 class="text-xl font-semibold leading-snug text-ink-800 group-hover:text-primary-600">{{ $service->name }}</h3>
                                    <p class="mt-3 flex-1 text-sm leading-6 text-ink-500">{{ $service->short_description }}</p>
                                    <div class="mt-6 flex items-center justify-between border-t border-ink-100 pt-4 text-xs font-semibold uppercase tracking-wider text-primary-600">
                                        Explore expertise <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="border-y border-ink-200 bg-white py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="reveal-left lg:col-span-5">
                    <p class="section-kicker">03 — Treatment focus</p>
                    <h2 class="mt-6 text-4xl font-semibold leading-tight text-ink-800 md:text-5xl">From source water to circular reuse.</h2>
                    <p class="mt-6 max-w-lg text-base leading-7 text-ink-500">Process, environmental and infrastructure engineering joined into one accountable delivery chain.</p>

                    <svg class="mt-10 hidden w-full max-w-sm text-accent-500 lg:block" viewBox="0 0 320 90" fill="none" aria-hidden="true">
                        <path class="draw-stroke" d="M4 62c40-52 78 30 118-14s78 34 118-16 72-14 76-6" stroke="currentColor" stroke-width="1.5" stroke-opacity=".55"/>
                        <path class="flow-stroke" d="M4 62c40-52 78 30 118-14s78 34 118-16 72-14 76-6" stroke="currentColor" stroke-width="2"/>
                        <circle class="pulse-node" cx="122" cy="48" r="4" fill="currentColor"/>
                        <circle class="pulse-node" style="animation-delay:1s" cx="240" cy="32" r="4" fill="currentColor"/>
                    </svg>
                </div>
                <div class="lg:col-span-7">
                    @foreach ([
                        ['01', 'truck', 'Sludge handling, reuse & solid waste management'],
                        ['02', 'fire', 'STP, ETP & CETP — anaerobic digestion, biogas, power and CBG'],
                        ['03', 'arrow-path', 'Wastewater reuse to potable and industrial standards'],
                        ['04', 'waves', 'Desalination and seawater treatment'],
                        ['05', 'bolt', 'Water systems for green hydrogen plants'],
                        ['06', 'droplet', 'Drinking water and direct or indirect potable reuse'],
                    ] as $index => [$number, $icon, $focus])
                        <div class="hover-row group grid grid-cols-[2rem_2.75rem_1fr_auto] items-center gap-4 border-t border-ink-200 py-5 last:border-b reveal {{ ['', 'delay-100', 'delay-200', 'delay-300', 'delay-400', 'delay-500'][$index] }}">
                            <span class="font-mono text-xs text-accent-600">{{ $number }}</span>
                            <span class="icon-tile h-11 w-11"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                            <p class="font-heading text-base font-medium text-ink-800 md:text-lg">{{ $focus }}</p>
                            <span class="h-2 w-2 border border-accent-600 transition-colors group-hover:bg-accent-500"></span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-14 grid gap-4 md:grid-cols-3">
                @foreach ([
                    ['images/source-water-intake.jpg', '01', 'Source', 'funnel', 'Raw-water intake & conveyance'],
                    ['images/treatment-process.jpg', '02', 'Process', 'adjustments-horizontal', 'Treatment systems & controls'],
                    ['images/circular-water-reuse.jpg', '03', 'Reuse', 'arrow-path', 'Polishing, recovery & circular use'],
                ] as $index => [$image, $number, $stage, $icon, $description])
                    <figure class="media-frame sheen group relative border border-ink-200 reveal {{ ['', 'delay-100', 'delay-200'][$index] }}">
                        <img
                            src="{{ asset($image) }}"
                            alt="{{ $description }} infrastructure"
                            class="aspect-[4/3] w-full object-cover"
                            width="1456"
                            height="1092"
                            loading="lazy"
                            decoding="async"
                        >
                        <div class="media-tint absolute inset-0"></div>
                        <span class="icon-tile icon-tile-dark absolute left-4 top-4 h-10 w-10 backdrop-blur-sm"><x-icon name="{{ $icon }}" class="h-4 w-4" /></span>
                        <div class="media-veil absolute inset-x-0 bottom-0 px-5 pb-5 pt-16 text-white">
                            <div class="flex items-end justify-between gap-4">
                                <div>
                                    <p class="font-mono text-[9px] uppercase tracking-[.18em] text-accent-200">{{ $number }} / {{ $stage }}</p>
                                    <figcaption class="mt-2 font-heading text-sm font-medium">{{ $description }}</figcaption>
                                </div>
                                <span class="pulse-node h-2 w-2 shrink-0 bg-accent-400"></span>
                            </div>
                        </div>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    @if ($supportingServices->count())
        <section class="bg-surface py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-6 border-b border-ink-200 pb-8 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="section-kicker">04 — Lifecycle coverage</p>
                        <h2 class="mt-6 max-w-2xl text-4xl font-semibold leading-tight text-ink-800">Residuals, assessment, design and operations — under one roof.</h2>
                    </div>
                    <a href="{{ route('expertise.index') }}" class="wf-btn-outline group">
                        Full expertise map <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                    </a>
                </div>

                <div class="mt-10 grid gap-px border border-ink-200 bg-ink-200 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($supportingServices as $index => $service)
                        <a href="{{ route('expertise.show', $service->slug) }}" class="group flex items-start gap-5 bg-white p-7 transition-colors hover:bg-surface reveal {{ ['', 'delay-100', 'delay-200'][$index % 3] }}">
                            <span class="icon-tile h-12 w-12"><x-icon name="{{ $service->icon ?? 'cog-6-tooth' }}" class="h-5 w-5" /></span>
                            <span class="flex-1">
                                <span class="section-index">{{ str_pad($index + 7, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="mt-2 block font-heading text-base font-medium leading-snug text-ink-800 group-hover:text-primary-600">
                                    <span class="underline-grow">{{ $service->name }}</span>
                                </span>
                                <span class="mt-3 line-clamp-2 text-sm leading-6 text-ink-500">{{ $service->short_description }}</span>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="flow-lines bg-primary-600 py-24 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="reveal-left lg:col-span-4">
                    <p class="section-kicker section-kicker-light">05 — Why WaterFirst</p>
                    <h2 class="mt-6 text-4xl font-semibold leading-tight text-white">Ownership is engineered into the process.</h2>
                    <x-icon name="waves" class="float-slow mt-10 hidden h-16 w-16 text-accent-300/70 lg:block" />
                </div>
                <div class="grid gap-px border border-primary-400 bg-primary-400 sm:grid-cols-2 lg:col-span-8">
                    @foreach ([
                        ['light-bulb', 'Creatively deliver high-quality solutions'],
                        ['map-pin', 'Comprehensive approach and region-specific focus'],
                        ['users', 'Close interaction with clients and project teams on site'],
                        ['lock-closed', 'Maintain ownership and respect confidentiality'],
                        ['scale', 'Cost-effective sustainable solutions — integrating all stakeholders involved'],
                    ] as $index => [$icon, $pillar])
                        <div class="group min-h-44 bg-primary-600 p-7 transition-colors hover:bg-primary-700 reveal {{ ['', 'delay-100', 'delay-200', 'delay-300', 'delay-400'][$index] }} {{ $index === 4 ? 'sm:col-span-2' : '' }}">
                            <div class="flex items-center justify-between">
                                <span class="icon-tile icon-tile-dark h-11 w-11"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                                <span class="font-mono text-xs text-accent-200">0{{ $index + 1 }}</span>
                            </div>
                            <p class="mt-7 max-w-md font-heading text-lg font-medium leading-7 text-white">{{ $pillar }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @if ($featuredCaseStudies->count())
        <section class="bg-surface py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-6 border-b border-ink-200 pb-8 md:flex-row md:items-end md:justify-between">
                    <div>
                        <p class="section-kicker">06 — Project record</p>
                        <h2 class="mt-6 text-4xl font-semibold text-ink-800 md:text-5xl">Measured by delivered outcomes.</h2>
                    </div>
                    <a href="{{ route('case-studies.index') }}" class="wf-btn-outline group">
                        All projects <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                    </a>
                </div>
                <div class="mt-8 grid gap-5 lg:grid-cols-3">
                    @foreach ($featuredCaseStudies as $index => $caseStudy)
                        @include('frontend.case-studies._card', ['cs' => $caseStudy, 'index' => $index + 1])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($industries->count())
        <section class="border-y border-ink-200 bg-white py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-12">
                    <div class="reveal-left lg:col-span-4">
                        <p class="section-kicker">07 — Sectors</p>
                        <h2 class="mt-6 text-3xl font-semibold text-ink-800">Where water performance is mission-critical.</h2>
                    </div>
                    <div class="grid sm:grid-cols-2 lg:col-span-8">
                        @foreach ($industries as $index => $industry)
                            <a href="{{ route('industries.show', $industry->slug) }}" class="hover-row group flex min-h-32 items-center gap-5 border-b border-ink-200 p-5 sm:border-r reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index % 4] }}">
                                <span class="font-mono text-xs text-accent-600">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="icon-tile h-12 w-12"><x-icon name="{{ $industry->icon ?? 'building-office-2' }}" class="h-5 w-5" /></span>
                                <span class="font-heading text-base font-medium leading-snug text-ink-800 group-hover:text-primary-600">
                                    <span class="underline-grow">{{ $industry->name }}</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="bg-surface py-20">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <div class="reveal-left lg:col-span-8">
                <div class="media-frame group relative border border-ink-200 bg-white">
                    <img src="{{ asset('images/waterfirst-india-footprint.svg') }}" alt="WaterFirst project footprint across India" class="w-full" loading="lazy">
                    <span class="icon-tile absolute left-4 top-4 h-10 w-10"><x-icon name="map-pin" class="h-4 w-4" /></span>
                </div>
            </div>
            <div class="reveal-right lg:col-span-4">
                <p class="section-kicker">08 — India focus</p>
                <h2 class="mt-6 text-3xl font-semibold text-ink-800">Local context. National project experience.</h2>
                <p class="mt-5 text-sm leading-7 text-ink-500">Experience spans BWSSB, KIADB, NMCG and RDWSB programmes across Karnataka, West Bengal, Uttar Pradesh and Odisha, plus industrial wastewater engineering in Iraq.</p>

                <div class="mt-7 grid gap-px border border-ink-200 bg-ink-200">
                    @foreach ([
                        ['building-library', 'Public programmes', 'BWSSB · KIADB · NMCG · RDWSB'],
                        ['map', 'States delivered', 'Karnataka · West Bengal · Uttar Pradesh · Odisha'],
                        ['globe-alt', 'International', 'Industrial wastewater engineering, Iraq'],
                    ] as $index => [$icon, $label, $detail])
                        <div class="group flex items-start gap-4 bg-white p-5 reveal {{ ['', 'delay-100', 'delay-200'][$index] }}">
                            <span class="icon-tile h-10 w-10"><x-icon name="{{ $icon }}" class="h-4 w-4" /></span>
                            <span>
                                <span class="block font-mono text-[10px] uppercase tracking-[.16em] text-primary-600">{{ $label }}</span>
                                <span class="mt-1.5 block text-sm leading-6 text-ink-500">{{ $detail }}</span>
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @if ($softwareLogos->count())
        <section class="border-t border-ink-200 bg-white py-14">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <p class="flex items-center justify-center gap-3 text-center font-mono text-[10px] uppercase tracking-[.18em] text-ink-500">
                    <x-icon name="cpu-chip" class="h-4 w-4 text-accent-500" />
                    Engineering software stack
                </p>
            </div>
            <div class="marquee mt-8">
                <div class="marquee-track">
                    @foreach ([false, true] as $isClone)
                        <div class="flex shrink-0 items-center gap-x-10 pr-10" @if ($isClone) aria-hidden="true" @endif>
                            @foreach ($softwareLogos as $logo)
                                <span class="flex items-center gap-2.5">
                                    @if ($logo->path)
                                        <img src="{{ asset($logo->path) }}" alt="{{ $isClone ? '' : $logo->name }}" class="h-9 w-auto max-w-28 object-contain" loading="lazy">
                                    @else
                                        <x-icon name="cube-transparent" class="h-4 w-4 text-accent-500" />
                                        <span class="whitespace-nowrap font-mono text-xs font-semibold uppercase tracking-wider text-primary-600">{{ $logo->name }}</span>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
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
