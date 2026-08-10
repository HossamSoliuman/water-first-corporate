@extends('layouts.app')

@section('content')
    @php($sec = $page->sections ?? [])
    <section class="interior-hero flow-lines py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'About', 'url' => route('company-overview')], ['name' => $page->title]]" />
            <div class="mt-12 grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3"><p class="section-kicker reveal">01 — People</p></div>
                <div class="lg:col-span-8">
                    <h1 class="reveal delay-100 text-5xl font-semibold leading-[1.05] text-ink-800 md:text-7xl">{{ $page->title }}</h1>
                    @if ($page->subtitle)
                        <p class="reveal delay-200 mt-7 max-w-3xl text-lg leading-8 text-ink-500">{{ $page->subtitle }}</p>
                    @endif

                    <div class="reveal delay-300 mt-10 flex flex-wrap gap-x-8 gap-y-4 border-t border-ink-200 pt-7">
                        @foreach ([
                            ['academic-cap', '15–35 years experience'],
                            ['squares-2x2', 'Five disciplines'],
                            ['users', 'Close to every project'],
                            ['map-pin', 'Based in Bangalore'],
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

    @include('frontend.partials.about-two-column', [
        'sec' => $sec,
        'introIcon' => 'users',
        'highlights' => [
            ['beaker', 'Process to automation', 'Process, mechanical, electrical, instrumentation and automation engineering.'],
            ['wrench-screwdriver', 'Design through operations', 'Experience that carries from drawing board to running plant.'],
            ['academic-cap', 'Founder-led', 'IIT Roorkee alumna with 19 years in water and wastewater treatment.'],
        ],
    ])

    <section class="border-y border-ink-200 bg-surface py-24">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <aside class="lg:col-span-3">
                <div class="sticky-label">
                    <p class="section-kicker">03 — Leadership</p>
                    <h2 class="mt-6 text-3xl font-semibold text-ink-800">Experience in the field.</h2>
                    <p class="mt-6 text-sm leading-7 text-ink-500">Senior engineers who stay on the project rather than hand it on.</p>

                    <svg class="mt-8 hidden w-full max-w-[13rem] text-accent-500 lg:block" viewBox="0 0 220 60" fill="none" aria-hidden="true">
                        <path class="draw-stroke" d="M4 40c30-34 56 22 84-8s54 24 82-10" stroke="currentColor" stroke-width="1.25" stroke-opacity=".5"/>
                        <path class="flow-stroke" d="M4 40c30-34 56 22 84-8s54 24 82-10" stroke="currentColor" stroke-width="1.75"/>
                        <circle class="pulse-node" cx="88" cy="32" r="3.5" fill="currentColor"/>
                    </svg>
                </div>
            </aside>

            <div class="grid gap-5 sm:grid-cols-2 lg:col-span-9">
                @foreach ($teamMembers as $index => $member)
                    <article class="wf-card group flex flex-col overflow-hidden reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index % 4] }}">
                        <div class="media-frame relative aspect-[4/3] w-full border-b border-ink-200">
                            @if ($member->photo)
                                <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}" class="h-full w-full object-cover object-top" loading="lazy" decoding="async">
                            @else
                                <div class="flow-lines flex h-full w-full items-center justify-center bg-primary-900">
                                    <x-icon name="user-circle" class="h-20 w-20 text-primary-300/60" />
                                </div>
                            @endif
                            <div class="media-tint absolute inset-0"></div>
                            <span class="absolute right-4 top-4 font-mono text-xs font-semibold tracking-[.12em] text-accent-200">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="icon-tile icon-tile-dark absolute bottom-4 left-4 h-11 w-11 backdrop-blur-sm">
                                <x-icon name="user-circle" class="h-5 w-5" />
                            </span>
                        </div>
                        <div class="flex flex-1 flex-col p-7">
                            <h3 class="font-heading text-xl font-semibold text-ink-800 group-hover:text-primary-600">
                                <span class="underline-grow">{{ $member->name }}</span>
                            </h3>
                            <p class="mt-2 flex-1 font-mono text-xs uppercase leading-6 tracking-wider text-primary-600">{{ $member->role }}</p>
                            <span class="mt-6 flex items-center gap-3 border-t border-ink-100 pt-4" aria-hidden="true">
                                <span class="h-px flex-1 bg-ink-200 transition-colors duration-300 group-hover:bg-accent-400"></span>
                                <span class="h-2 w-2 border border-accent-600 transition-colors duration-300 group-hover:bg-accent-500"></span>
                            </span>
                        </div>
                    </article>
                @endforeach

                <article class="technical-rule flex flex-col justify-between bg-white p-7 reveal delay-100">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="icon-tile h-12 w-12"><x-icon name="sparkles" class="h-5 w-5" /></span>
                            <span class="pulse-node h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                        </div>
                        <h3 class="mt-7 font-heading text-xl font-semibold text-ink-800">Join the practice</h3>
                        <p class="mt-3 text-sm leading-6 text-ink-500">We hire engineers who want ownership of the technical outcome, not just a drawing package.</p>
                    </div>
                    <a href="{{ route('careers') }}" class="group mt-7 inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:text-secondary-500">
                        See open roles <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                    </a>
                </article>
            </div>
        </div>
    </section>

    <section class="deep-band flow-lines py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <p class="section-kicker section-kicker-light">04 — Experience profile</p>
            <div class="mt-10 grid grid-cols-2 gap-px border border-primary-500 bg-primary-500 md:grid-cols-4">
                @foreach ([
                    ['clock', '19', '', 19, 'Years founder experience'],
                    ['academic-cap', '15–35', '', null, 'Years across the team'],
                    ['squares-2x2', '5', '', 5, 'Engineering disciplines'],
                    ['arrow-path', '360', '°', 360, 'Design to operations'],
                ] as $index => [$icon, $value, $unit, $countTo, $label])
                    <div class="group bg-primary-600 px-5 py-8 md:px-7 reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }}">
                        <span class="icon-tile icon-tile-dark h-10 w-10"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                        <p class="mt-5 font-mono text-2xl font-semibold text-white md:text-3xl">
                            @if ($countTo)
                                <span data-count-to="{{ $countTo }}">{{ $value }}</span>{{ $unit }}
                            @else
                                {{ $value }}{{ $unit }}
                            @endif
                        </p>
                        <p class="mt-2 text-xs leading-5 text-primary-100">{{ $label }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('frontend.partials.about-nav')
@endsection
