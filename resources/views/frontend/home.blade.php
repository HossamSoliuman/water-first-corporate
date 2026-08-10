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
                    <a href="{{ route('expertise.index') }}" class="wf-btn-light group">
                        Explore water engineering
                        <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                    </a>
                    <a href="{{ route('case-studies.index') }}" class="wf-btn-outline border-accent-300 text-white hover:bg-primary-700">
                        View project record
                    </a>
                </div>
            </div>

            <div class="reveal-scale lg:col-span-5">
                <div class="border border-primary-300/60 bg-primary-950/75 p-6 shadow-2xl backdrop-blur-sm md:p-8">
                    <div class="flex items-center justify-between border-b border-primary-500 pb-4">
                        <span class="font-mono text-[10px] uppercase tracking-[.18em] text-accent-200">Treatment train / 01</span>
                        <span class="h-2 w-2 bg-accent-400"></span>
                    </div>
                    <svg viewBox="0 0 420 260" class="mt-6 w-full" role="img" aria-label="Water treatment process diagram">
                        <g fill="none" stroke="#D9EEFF" stroke-width="1.5">
                            <path d="M20 132h68m52 0h68m52 0h68m52 0h30"/>
                            <path d="m78 124 10 8-10 8m120-16 10 8-10 8m120-16 10 8-10 8"/>
                        </g>
                        <g fill="#07579A" stroke="#00A6A6" stroke-width="2">
                            <rect x="88" y="90" width="52" height="84"/><circle cx="234" cy="132" r="42"/><path d="M328 90h52v84h-52z"/>
                        </g>
                        <g fill="#FFFFFF" font-family="IBM Plex Mono,monospace" font-size="10" text-anchor="middle">
                            <text x="114" y="204">INTAKE</text><text x="234" y="204">PROCESS</text><text x="354" y="204">REUSE</text>
                        </g>
                        <g stroke="#00A6A6" stroke-opacity=".75">
                            <path d="M96 108h36m-36 12h36m-36 12h36m-36 12h36m-36 12h36"/>
                            <path d="M206 132h56M234 104v56"/>
                            <path d="M336 148c7-12 13-19 18-30 6 11 12 18 18 30" fill="none"/>
                        </g>
                    </svg>
                    <div class="grid grid-cols-3 border-t border-primary-500 pt-5 text-center">
                        @foreach ([['15–35', 'YEARS EXP.'], ['12', 'EXPERTISE AREAS'], ['360°', 'LIFECYCLE']] as [$value, $label])
                            <div class="border-r border-primary-500 last:border-0">
                                <p class="font-mono text-xl font-semibold text-white">{{ $value }}</p>
                                <p class="mt-1 font-mono text-[8px] tracking-[.14em] text-primary-200">{{ $label }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="border-b border-ink-200 bg-white">
        <div class="mx-auto grid max-w-7xl grid-cols-2 px-4 sm:px-6 md:grid-cols-4 lg:px-8">
            @foreach ([['19', 'Years founder experience'], ['80 MLD', 'Largest listed sewer package'], ['15 YRS', 'Long-term O&M scope'], ['5', 'Why WaterFirst pillars']] as [$value, $label])
                <div class="border-r border-ink-200 px-4 py-8 last:border-r-0 md:px-7">
                    <p class="metric text-2xl font-semibold md:text-3xl">{{ $value }}</p>
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
                            <a href="{{ route('expertise.index') }}" class="mt-7 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-secondary-500">
                                All 12 expertise areas <x-icon name="arrow-long-right" class="h-4 w-4" />
                            </a>
                        </div>
                    </div>
                    <div class="grid gap-5 md:grid-cols-2 lg:col-span-9">
                        @foreach ($featuredServices as $index => $service)
                            <a href="{{ route('expertise.show', $service->slug) }}" class="wf-card group flex min-h-64 flex-col p-7 reveal">
                                <div class="flex items-start justify-between gap-5">
                                    <span class="flex h-11 w-11 items-center justify-center border border-accent-500 text-accent-600">
                                        <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-5 w-5" />
                                    </span>
                                    <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <h3 class="mt-8 text-xl font-semibold leading-snug text-ink-800 group-hover:text-primary-600">{{ $service->name }}</h3>
                                <p class="mt-3 flex-1 text-sm leading-6 text-ink-500">{{ $service->short_description }}</p>
                                <div class="mt-6 border-t border-ink-100 pt-4 text-xs font-semibold uppercase tracking-wider text-primary-600">Explore expertise</div>
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
                <div class="lg:col-span-5">
                    <p class="section-kicker">03 — Treatment focus</p>
                    <h2 class="mt-6 text-4xl font-semibold leading-tight text-ink-800 md:text-5xl">From source water to circular reuse.</h2>
                    <p class="mt-6 max-w-lg text-base leading-7 text-ink-500">Process, environmental and infrastructure engineering joined into one accountable delivery chain.</p>
                </div>
                <div class="lg:col-span-7">
                    @foreach ([
                        ['01', 'Sludge handling, reuse & solid waste management'],
                        ['02', 'STP, ETP & CETP — anaerobic digestion, biogas, power and CBG'],
                        ['03', 'Wastewater reuse to potable and industrial standards'],
                        ['04', 'Desalination and seawater treatment'],
                        ['05', 'Water systems for green hydrogen plants'],
                        ['06', 'Drinking water and direct or indirect potable reuse'],
                    ] as [$number, $focus])
                        <div class="group grid grid-cols-[3rem_1fr_auto] items-center gap-4 border-t border-ink-200 py-5 last:border-b">
                            <span class="font-mono text-xs text-accent-600">{{ $number }}</span>
                            <p class="font-heading text-base font-medium text-ink-800 md:text-lg">{{ $focus }}</p>
                            <span class="h-2 w-2 border border-accent-600 transition-colors group-hover:bg-accent-500"></span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-14 grid gap-4 md:grid-cols-3">
                @foreach ([
                    ['images/source-water-intake.jpg', '01', 'Source', 'Raw-water intake & conveyance'],
                    ['images/treatment-process.jpg', '02', 'Process', 'Treatment systems & controls'],
                    ['images/circular-water-reuse.jpg', '03', 'Reuse', 'Polishing, recovery & circular use'],
                ] as [$image, $number, $stage, $description])
                    <figure class="group relative overflow-hidden border border-ink-200 bg-primary-950 reveal">
                        <img
                            src="{{ asset($image) }}"
                            alt="{{ $description }} infrastructure"
                            class="aspect-[4/3] w-full object-cover transition duration-700 group-hover:scale-[1.025]"
                            width="1456"
                            height="1092"
                            loading="lazy"
                            decoding="async"
                        >
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-primary-950 via-primary-950/80 to-transparent px-5 pb-5 pt-16 text-white">
                            <div class="flex items-end justify-between gap-4">
                                <div>
                                    <p class="font-mono text-[9px] uppercase tracking-[.18em] text-accent-200">{{ $number }} / {{ $stage }}</p>
                                    <figcaption class="mt-2 font-heading text-sm font-medium">{{ $description }}</figcaption>
                                </div>
                                <span class="h-2 w-2 shrink-0 bg-accent-400"></span>
                            </div>
                        </div>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-primary-600 py-24 text-white flow-lines">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <p class="section-kicker section-kicker-light">04 — Why WaterFirst</p>
                    <h2 class="mt-6 text-4xl font-semibold leading-tight text-white">Ownership is engineered into the process.</h2>
                </div>
                <div class="grid gap-px border border-primary-400 bg-primary-400 sm:grid-cols-2 lg:col-span-8">
                    @foreach ([
                        'Creatively deliver high-quality solutions',
                        'Comprehensive approach and region-specific focus',
                        'Close interaction with clients and project teams on site',
                        'Maintain ownership and respect confidentiality',
                        'Cost-effective sustainable solutions — integrating all stakeholders involved',
                    ] as $index => $pillar)
                        <div class="min-h-44 bg-primary-600 p-7 {{ $index === 4 ? 'sm:col-span-2' : '' }}">
                            <span class="font-mono text-xs text-accent-200">0{{ $index + 1 }}</span>
                            <p class="mt-8 max-w-md font-heading text-lg font-medium leading-7 text-white">{{ $pillar }}</p>
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
                        <p class="section-kicker">05 — Project record</p>
                        <h2 class="mt-6 text-4xl font-semibold text-ink-800 md:text-5xl">Measured by delivered outcomes.</h2>
                    </div>
                    <a href="{{ route('case-studies.index') }}" class="wf-btn-outline">All projects</a>
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
                    <div class="lg:col-span-4">
                        <p class="section-kicker">06 — Sectors</p>
                        <h2 class="mt-6 text-3xl font-semibold text-ink-800">Where water performance is mission-critical.</h2>
                    </div>
                    <div class="grid sm:grid-cols-2 lg:col-span-8">
                        @foreach ($industries as $index => $industry)
                            <a href="{{ route('industries.show', $industry->slug) }}" class="group flex min-h-32 items-center gap-5 border-b border-ink-200 p-5 sm:border-r">
                                <span class="font-mono text-xs text-accent-600">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="font-heading text-base font-medium leading-snug text-ink-800 group-hover:text-primary-600">{{ $industry->name }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="bg-surface py-20">
        <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <div class="lg:col-span-8">
                <img src="{{ asset('images/waterfirst-india-footprint.svg') }}" alt="WaterFirst project footprint across India" class="w-full border border-ink-200 bg-white" loading="lazy">
            </div>
            <div class="lg:col-span-4">
                <p class="section-kicker">07 — India focus</p>
                <h2 class="mt-6 text-3xl font-semibold text-ink-800">Local context. National project experience.</h2>
                <p class="mt-5 text-sm leading-7 text-ink-500">Experience spans BWSSB, KIADB, NMCG and RDWSB programmes across Karnataka, West Bengal, Uttar Pradesh and Odisha, plus industrial wastewater engineering in Iraq.</p>
            </div>
        </div>
    </section>

    @if ($softwareLogos->count())
        <section class="border-t border-ink-200 bg-white py-14">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <p class="text-center font-mono text-[10px] uppercase tracking-[.18em] text-ink-500">Engineering software stack</p>
                <div class="mt-8 flex flex-wrap items-center justify-center gap-x-10 gap-y-6">
                    @foreach ($softwareLogos as $logo)
                        @if ($logo->path)
                            <img src="{{ asset($logo->path) }}" alt="{{ $logo->name }}" class="h-9 w-auto max-w-28 object-contain" loading="lazy">
                        @else
                            <span class="font-mono text-xs font-semibold uppercase tracking-wider text-primary-600">{{ $logo->name }}</span>
                        @endif
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
