@extends('layouts.app')

@section('content')
    @php($sec = $page->sections ?? [])
    <section class="interior-hero flow-lines py-10 md:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'About', 'url' => route('company-overview')], ['name' => $page->title]]" />
            <div class="mt-6 grid gap-x-8 gap-y-5 lg:grid-cols-12">
                <div class="lg:col-span-12">
                    <h1 class="reveal delay-100 text-[clamp(1.75rem,3.6vw,3rem)] font-semibold leading-[1.05] text-ink-800">{{ $page->title }}</h1>
                    @if ($page->subtitle)
                        <p class="reveal delay-200 mt-5 max-w-3xl text-lg leading-8 text-ink-500">{{ $page->subtitle }}</p>
                    @endif

                    <div class="reveal delay-300 mt-8 flex flex-wrap gap-x-8 gap-y-4 border-t border-ink-200 pt-6">
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
        'stats' => [
            ['clock', '19', '', 19, 'Years founder experience'],
            ['academic-cap', '15–35', '', null, 'Years across the team'],
            ['squares-2x2', '5', '', 5, 'Engineering disciplines'],
            ['arrow-path', '360', '°', 360, 'Design to operations'],
        ],
    ])

    <section class="border-y border-ink-200 bg-surface py-14 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-end justify-between gap-x-10 gap-y-5">
                <div>
                    <h2 class="text-3xl font-semibold text-ink-800">Experience in the field.</h2>
                    <p class="mt-4 max-w-xl text-sm leading-7 text-ink-500">Senior engineers who stay on the project rather than hand it on.</p>
                </div>
                <p class="text-sm leading-7 text-ink-500">
                    We hire engineers who want ownership of the technical outcome.
                    <a href="{{ route('careers') }}" class="group ml-1 inline-flex items-center gap-2 font-semibold text-primary-600 hover:text-secondary-500">
                        See open roles <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                    </a>
                </p>
            </div>

            <div class="mt-9 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($teamMembers as $index => $member)
                    <article class="wf-card group flex flex-col overflow-hidden reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index % 4] }}">
                        <div class="media-frame aspect-[4/3] w-full border-b border-ink-200">
                            @if ($member->photo)
                                <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}" class="h-full w-full object-cover object-top" loading="lazy" decoding="async">
                            @else
                                <div class="flex h-full w-full items-center justify-center bg-primary-900">
                                    <x-icon name="user-circle" class="h-16 w-16 text-primary-300/60" />
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-heading text-xl font-semibold text-ink-800 group-hover:text-primary-600">{{ $member->name }}</h3>
                            <p class="mt-2 font-mono text-xs uppercase leading-6 tracking-wider text-primary-600">{{ $member->role }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
