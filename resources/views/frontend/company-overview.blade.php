@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'Company Overview']]" />
            <div class="mt-12 grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3"><p class="section-kicker reveal">01 — Company</p></div>
                <div class="lg:col-span-8">
                    <h1 class="reveal delay-100 text-5xl font-semibold leading-[1.05] text-ink-800 md:text-7xl">Water is first in every system we engineer.</h1>
                    <p class="reveal delay-200 mt-7 max-w-3xl text-lg leading-8 text-ink-500">WaterFirst Engineering Consultancy Private Limited is a Bangalore-based environmental and infrastructure engineering practice focused on difficult water and wastewater problems.</p>

                    <div class="reveal delay-300 mt-10 flex flex-wrap gap-x-8 gap-y-4 border-t border-ink-200 pt-7">
                        @foreach ([
                            ['map-pin', 'Bangalore, Karnataka'],
                            ['droplet', 'Water & wastewater led'],
                            ['squares-2x2', 'Multi-disciplinary'],
                            ['arrow-path', 'Design to operations'],
                        ] as [$icon, $label])
                            <span class="group flex items-center gap-3">
                                <span class="icon-tile h-9 w-9"><x-icon name="{{ $icon }}" class="h-4 w-4" /></span>
                                <span class="font-mono text-[10px] uppercase tracking-[.16em] text-ink-500">{{ $label }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-24">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <aside class="lg:col-span-3">
                <div class="sticky-label">
                    <p class="section-kicker">02 — Our position</p>
                    <x-icon name="waves" class="float-slow mt-8 hidden h-12 w-12 text-accent-300 lg:block" />
                </div>
            </aside>
            <div class="grid gap-12 lg:col-span-9 md:grid-cols-5">
                <div class="md:col-span-3 reveal-left">
                    <h2 class="text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">Sustainable technical solutions to challenging environmental problems.</h2>
                    <div class="technical-rule mt-7 grid gap-5 pl-6 text-base leading-8 text-ink-500">
                        <p>We work across municipal and industrial water, wastewater, solids management, effluent treatment, sewerage, water supply, waterbody rejuvenation and operations.</p>
                        <p>Our team brings 15–35 years of experience in process, mechanical, electrical, instrumentation and automation engineering, backed by field interaction and regulatory awareness.</p>
                        <p>Our treatment experience spans seawater, river water and groundwater, with conventional and advanced processes selected to protect public health, receiving waterbodies, flora and fauna.</p>
                    </div>

                    <div class="mt-10 grid gap-px border border-ink-200 bg-ink-200 sm:grid-cols-3">
                        @foreach ([
                            ['shield-check', 'Public health', 'Protected at every design decision'],
                            ['waves', 'Receiving waters', 'Discharge quality held to standard'],
                            ['globe-alt', 'Flora & fauna', 'Ecological outcomes considered'],
                        ] as $index => [$icon, $label, $detail])
                            <div class="group bg-white p-5 reveal {{ ['', 'delay-100', 'delay-200'][$index] }}">
                                <span class="icon-tile h-10 w-10"><x-icon name="{{ $icon }}" class="h-4 w-4" /></span>
                                <p class="mt-4 font-mono text-[10px] uppercase tracking-[.16em] text-primary-600">{{ $label }}</p>
                                <p class="mt-1.5 text-sm leading-6 text-ink-500">{{ $detail }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="md:col-span-2 reveal-right">
                    <div class="technical-rule bg-surface p-7">
                        <div class="flex items-center justify-between">
                            <p class="font-mono text-xs uppercase tracking-[.16em] text-primary-600">Founder</p>
                            <span class="icon-tile h-10 w-10"><x-icon name="user-circle" class="h-5 w-5" /></span>
                        </div>
                        <h3 class="mt-5 text-2xl font-semibold text-ink-800">Uma Upadhyay</h3>
                        <p class="mt-3 text-sm leading-7 text-ink-500">IIT Roorkee alumna with a postgraduate qualification in Environmental Engineering and 19 years of water and wastewater treatment experience.</p>

                        <div class="mt-6 grid gap-3 border-t border-ink-200 pt-5">
                            @foreach ([
                                ['academic-cap', 'IIT Roorkee alumna'],
                                ['document-text', 'PG — Environmental Engineering'],
                                ['clock', '19 years in water & wastewater'],
                            ] as [$icon, $credential])
                                <span class="group flex items-center gap-3">
                                    <span class="icon-tile h-8 w-8"><x-icon name="{{ $icon }}" class="h-3.5 w-3.5" /></span>
                                    <span class="text-sm leading-6 text-ink-500">{{ $credential }}</span>
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-5 border border-primary-800 bg-primary-950 p-7 text-white">
                        <div class="flex items-center justify-between border-b border-primary-800 pb-4">
                            <span class="font-mono text-[10px] uppercase tracking-[.18em] text-accent-200">Practice profile</span>
                            <span class="pulse-node h-1.5 w-1.5 rounded-full bg-accent-400"></span>
                        </div>

                        <svg viewBox="0 0 240 128" class="mt-6 w-full" role="img" aria-label="Animated diagram of water flowing through the WaterFirst practice">
                            <g stroke="#1686C4" stroke-opacity=".35" stroke-width=".75">
                                <path d="M0 26h240M0 102h240"/>
                            </g>
                            <circle class="spin-ring" cx="120" cy="64" r="42" fill="none" stroke="#67E5E5" stroke-opacity=".4" stroke-width="1.25" stroke-dasharray="5 13"/>
                            <circle cx="120" cy="64" r="30" fill="#07579A" fill-opacity=".45" stroke="#00A6A6" stroke-width="1.5"/>
                            <path d="M120 46c5.4 6.7 9.3 11.6 9.3 16.1a9.3 9.3 0 0 1-18.6 0c0-4.5 3.9-9.4 9.3-16.1z" fill="none" stroke="#A5F3F3" stroke-opacity=".9" stroke-width="1.4"/>
                            <g stroke="#67E5E5" stroke-width="2.5" stroke-linecap="round" fill="none">
                                <path class="flow-stroke" d="M8 64h60"/>
                                <path class="flow-stroke" style="animation-delay:.8s" d="M172 64h60"/>
                            </g>
                            <g fill="#67E5E5">
                                <circle class="pulse-node" cx="20" cy="64" r="3"/>
                                <circle class="pulse-node" style="animation-delay:1.4s" cx="220" cy="64" r="3"/>
                            </g>
                        </svg>

                        <div class="mt-6 grid grid-cols-3 border-t border-primary-800 pt-5 text-center">
                            @foreach ([
                                ['19', '', 19, 'FOUNDER YRS'],
                                ['15–35', '', null, 'TEAM YRS'],
                                ['12', '', 12, 'EXPERTISE'],
                            ] as [$value, $unit, $countTo, $label])
                                <div class="border-r border-primary-800 last:border-0">
                                    <p class="font-mono text-xl font-semibold text-white">
                                        @if ($countTo)
                                            <span data-count-to="{{ $countTo }}">{{ $value }}</span>{{ $unit }}
                                        @else
                                            {{ $value }}{{ $unit }}
                                        @endif
                                    </p>
                                    <p class="mt-1 font-mono text-[8px] tracking-[.14em] text-primary-200">{{ $label }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-ink-200 bg-surface py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 border-b border-ink-200 pb-8 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="section-kicker">03 — Practice scope</p>
                    <h2 class="mt-6 max-w-2xl text-4xl font-semibold leading-tight text-ink-800">Everything water touches, engineered end to end.</h2>
                </div>
                <a href="{{ route('expertise.index') }}" class="wf-btn-outline group">
                    Full expertise map <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                </a>
            </div>

            <div class="mt-10 grid gap-px border border-ink-200 bg-ink-200 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['building-library', 'Municipal & industrial water', 'Supply and treatment for cities and plants.'],
                    ['waves', 'Wastewater', 'Collection, treatment and safe discharge.'],
                    ['truck', 'Solids management', 'Sludge handling, reuse and residuals.'],
                    ['beaker', 'Effluent treatment', 'Process effluent to compliant quality.'],
                    ['funnel', 'Sewerage', 'Networks, pumping and conveyance.'],
                    ['droplet', 'Water supply', 'Source to distribution infrastructure.'],
                    ['globe-alt', 'Waterbody rejuvenation', 'Restoring lakes and receiving waters.'],
                    ['wrench-screwdriver', 'Operations', 'Running and optimising built assets.'],
                ] as $index => [$icon, $label, $detail])
                    <div class="group flex flex-col bg-white p-7 transition-colors hover:bg-surface reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index % 4] }}">
                        <div class="flex items-start justify-between gap-4">
                            <span class="icon-tile h-12 w-12"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                            <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h3 class="mt-6 font-heading text-base font-medium leading-snug text-ink-800 group-hover:text-primary-600">
                            <span class="underline-grow">{{ $label }}</span>
                        </h3>
                        <p class="mt-2.5 text-sm leading-6 text-ink-500">{{ $detail }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="border-b border-ink-200 bg-white py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="reveal-left lg:col-span-4">
                    <p class="section-kicker">04 — Disciplines</p>
                    <h2 class="mt-6 text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">Five engineering disciplines, one delivery team.</h2>
                    <p class="mt-6 max-w-lg text-base leading-7 text-ink-500">15–35 years of experience per discipline, backed by field interaction and regulatory awareness.</p>

                    <svg class="mt-10 hidden w-full max-w-sm text-accent-500 lg:block" viewBox="0 0 320 80" fill="none" aria-hidden="true">
                        <path class="draw-stroke" d="M4 54c44-46 86 26 130-6s70 30 182-14" stroke="currentColor" stroke-width="1.5" stroke-opacity=".55"/>
                        <path class="flow-stroke" d="M4 54c44-46 86 26 130-6s70 30 182-14" stroke="currentColor" stroke-width="2"/>
                        <circle class="pulse-node" cx="134" cy="48" r="4" fill="currentColor"/>
                    </svg>
                </div>

                <div class="lg:col-span-8">
                    @foreach ([
                        ['01', 'beaker', 'Process engineering', 'Treatment selection, mass balance and unit-process design.'],
                        ['02', 'cog-6-tooth', 'Mechanical engineering', 'Equipment, hydraulics and plant layout.'],
                        ['03', 'bolt', 'Electrical engineering', 'Power distribution, drives and plant supply.'],
                        ['04', 'signal', 'Instrumentation', 'Measurement, monitoring and control loops.'],
                        ['05', 'cpu-chip', 'Automation', 'SCADA, sequencing and operational logic.'],
                    ] as $index => [$number, $icon, $discipline, $detail])
                        <div class="hover-row group grid grid-cols-[2rem_2.75rem_1fr_auto] items-center gap-4 border-t border-ink-200 py-5 last:border-b reveal {{ ['', 'delay-100', 'delay-200', 'delay-300', 'delay-400'][$index] }}">
                            <span class="font-mono text-xs text-accent-600">{{ $number }}</span>
                            <span class="icon-tile h-11 w-11"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                            <span>
                                <span class="block font-heading text-base font-medium text-ink-800 md:text-lg">{{ $discipline }}</span>
                                <span class="mt-1 block text-sm leading-6 text-ink-500">{{ $detail }}</span>
                            </span>
                            <span class="h-2 w-2 border border-accent-600 transition-colors group-hover:bg-accent-500"></span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-surface py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3">
                    <div class="sticky-label">
                        <p class="section-kicker">05 — Source waters</p>
                        <h2 class="mt-6 text-3xl font-semibold leading-tight text-ink-800">Treatment experience across every source.</h2>
                        <p class="mt-6 text-sm leading-7 text-ink-500">Conventional and advanced processes, selected for the raw water actually available.</p>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-3 lg:col-span-9">
                    @foreach ([
                        ['waves', 'Seawater', 'Desalination and high-salinity treatment for coastal and industrial supply.'],
                        ['droplet', 'River water', 'Surface abstraction with variable quality and seasonal load.'],
                        ['funnel', 'Groundwater', 'Borewell sources requiring targeted contaminant removal.'],
                    ] as $index => [$icon, $source, $detail])
                        <article class="wf-card group flex flex-col p-7 reveal {{ ['', 'delay-100', 'delay-200'][$index] }}">
                            <div class="flex items-start justify-between gap-4">
                                <span class="icon-tile h-12 w-12"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                                <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <h3 class="mt-7 font-heading text-lg font-semibold text-ink-800 group-hover:text-primary-600">
                                <span class="underline-grow">{{ $source }}</span>
                            </h3>
                            <p class="mt-3 flex-1 text-sm leading-6 text-ink-500">{{ $detail }}</p>
                            <span class="mt-6 flex items-center gap-3 border-t border-ink-100 pt-4" aria-hidden="true">
                                <span class="h-px flex-1 bg-ink-200 transition-colors duration-300 group-hover:bg-accent-400"></span>
                                <span class="h-2 w-2 border border-accent-600 transition-colors duration-300 group-hover:bg-accent-500"></span>
                            </span>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-ink-200 bg-white py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="border-b border-ink-200 pb-8">
                <p class="section-kicker">06 — Operating principles</p>
                <h2 class="mt-6 max-w-2xl text-4xl font-semibold leading-tight text-ink-800">How every engagement is held to account.</h2>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['01', 'clock', 'Time-bound delivery', 'Structured programmes and decisive technical coordination.'],
                    ['02', 'scale', 'Cost-effective design', 'Fiscally responsible options grounded in lifecycle value.'],
                    ['03', 'users', 'Customer focus', 'Close interaction with client and project teams on site.'],
                    ['04', 'shield-check', 'Regulatory compliance', 'Solutions aligned with NGT, MoEF&CC and CPCB requirements.'],
                ] as $index => [$number, $icon, $title, $copy])
                    <article class="wf-card group flex flex-col p-7 reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }}">
                        <div class="flex items-start justify-between gap-4">
                            <span class="icon-tile h-12 w-12"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                            <span class="section-index">{{ $number }}</span>
                        </div>
                        <h3 class="mt-7 font-heading text-lg font-semibold text-ink-800 group-hover:text-primary-600">
                            <span class="underline-grow">{{ $title }}</span>
                        </h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-ink-500">{{ $copy }}</p>
                        <span class="mt-6 flex items-center gap-3 border-t border-ink-100 pt-4" aria-hidden="true">
                            <span class="h-px flex-1 bg-ink-200 transition-colors duration-300 group-hover:bg-accent-400"></span>
                            <span class="h-2 w-2 border border-accent-600 transition-colors duration-300 group-hover:bg-accent-500"></span>
                        </span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @include('frontend.partials.about-nav')
@endsection
