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
                            ['light-bulb', 'Creative solutions'],
                            ['map-pin', 'Region-specific'],
                            ['users', 'On-site collaboration'],
                            ['lock-closed', 'Confidential by default'],
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
        'introIcon' => 'shield-check',
        'highlights' => [
            ['light-bulb', 'Creative problem-solving', 'Technical rigour applied to problems without an off-the-shelf answer.'],
            ['map', 'Region-specific approach', 'Local water, regulatory and operating conditions drive the design.'],
            ['users', 'Grounded in field reality', 'We stay close to client and project teams on site.'],
        ],
    ])

    @include('frontend.partials.about-cards', [
        'cards' => $cards,
        'cardsHeading' => 'Reasons to partner with us',
        'cardsCountLabel' => 'commitments',
        'gridCols' => 3,
        'cardIcons' => ['light-bulb', 'map-pin', 'users', 'lock-closed', 'scale'],
    ])

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="reveal-left lg:col-span-4">
                    <h2 class="text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">What holds true on every project.</h2>
                    <p class="mt-6 max-w-lg text-base leading-7 text-ink-500">Sustainable outcomes pursued without losing sight of time or cost.</p>

                    <svg class="mt-10 hidden w-full max-w-sm text-accent-500 lg:block" viewBox="0 0 320 80" fill="none" aria-hidden="true">
                        <path class="draw-stroke" d="M4 50c46-42 84 24 128-4s72 26 184-16" stroke="currentColor" stroke-width="1.5" stroke-opacity=".55"/>
                        <path class="flow-stroke" d="M4 50c46-42 84 24 128-4s72 26 184-16" stroke="currentColor" stroke-width="2"/>
                        <circle class="pulse-node" cx="132" cy="46" r="4" fill="currentColor"/>
                    </svg>
                </div>

                <div class="grid gap-px border border-ink-200 bg-ink-200 sm:grid-cols-2 lg:col-span-8">
                    @foreach ([
                        ['lock-closed', 'Confidentiality protected', 'Sensitive project and client information stays contained.'],
                        ['users', 'Stakeholders integrated', 'Every party with a stake in the outcome is brought into the process.'],
                        ['globe-alt', 'Sustainable outcomes', 'Environmental performance weighed alongside capital cost.'],
                        ['clock', 'Time and cost held', 'Programme and budget tracked as engineering constraints.'],
                    ] as $index => [$icon, $label, $detail])
                        <div class="group flex min-h-40 flex-col justify-between bg-white p-7 transition-colors hover:bg-surface reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }}">
                            <div class="flex items-center justify-between">
                                <span class="icon-tile h-11 w-11"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                                <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="mt-7">
                                <p class="font-heading text-base font-medium leading-snug text-ink-800 group-hover:text-primary-600">
                                    <span class="underline-grow">{{ $label }}</span>
                                </p>
                                <p class="mt-2 text-sm leading-6 text-ink-500">{{ $detail }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
