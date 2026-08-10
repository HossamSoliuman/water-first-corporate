@extends('layouts.app')

@section('content')
    @php($sec = $page->sections ?? [])
    <section class="interior-hero flow-lines py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'About', 'url' => route('company-overview')], ['name' => $page->title]]" />
            <div class="mt-12 grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3"><p class="section-kicker reveal">01 — Engagement</p></div>
                <div class="lg:col-span-8">
                    <h1 class="reveal delay-100 text-5xl font-semibold leading-[1.05] text-ink-800 md:text-7xl">{{ $page->title }}</h1>
                    @if ($page->subtitle)
                        <p class="reveal delay-200 mt-7 max-w-3xl text-lg leading-8 text-ink-500">{{ $page->subtitle }}</p>
                    @endif

                    <div class="reveal delay-300 mt-10 flex flex-wrap gap-x-8 gap-y-4 border-t border-ink-200 pt-7">
                        @foreach ([
                            ['clipboard-document-list', 'Studies & DPR'],
                            ['pencil-square', 'Detailed engineering'],
                            ['presentation-chart-line', 'Delivery support'],
                            ['wrench-screwdriver', 'Long-term O&M'],
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
        'introIcon' => 'scale',
        'highlights' => [
            ['funnel', 'Scope', 'Defined against the decision the client needs to make.'],
            ['shield-check', 'Responsibility', 'Technical ownership stays with us in every model.'],
            ['presentation-chart-line', 'Reporting', 'Transparent communication throughout delivery.'],
        ],
    ])

    @include('frontend.partials.about-cards', [
        'cards' => $cards,
        'cardsLabel' => 'Flexible delivery',
        'cardsHeading' => 'Engagement models',
        'cardsCountLabel' => 'models',
        'cardIcons' => ['clipboard-document-list', 'clock', 'presentation-chart-line', 'wrench-screwdriver'],
    ])

    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="reveal-left lg:col-span-4">
                    <p class="section-kicker">04 — Project stage</p>
                    <h2 class="mt-6 text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">The commitment matches the stage.</h2>
                    <p class="mt-6 max-w-lg text-base leading-7 text-ink-500">A focused study, a defined engineering package and a long-term operations programme each ask for a different structure.</p>

                    <a href="{{ route('contact') }}" class="wf-btn-primary group mt-8">
                        Discuss your project <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                    </a>
                </div>

                <div class="lg:col-span-8">
                    @foreach ([
                        ['01', 'light-bulb', 'Study & feasibility', 'Options assessed before capital is committed.'],
                        ['02', 'pencil-square', 'Detailed engineering', 'DPR, FEED and design packages issued for construction.'],
                        ['03', 'presentation-chart-line', 'Delivery & oversight', 'Coordination, quality review and technical support on site.'],
                        ['04', 'arrow-path', 'Operations & optimisation', 'Performance held over the life of the asset.'],
                    ] as $index => [$number, $icon, $stage, $detail])
                        <div class="hover-row group grid grid-cols-[2rem_2.75rem_1fr_auto] items-center gap-4 border-t border-ink-200 py-5 last:border-b reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }}">
                            <span class="font-mono text-xs text-accent-600">{{ $number }}</span>
                            <span class="icon-tile h-11 w-11"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                            <span>
                                <span class="block font-heading text-base font-medium text-ink-800 md:text-lg">{{ $stage }}</span>
                                <span class="mt-1 block text-sm leading-6 text-ink-500">{{ $detail }}</span>
                            </span>
                            <span class="h-2 w-2 border border-accent-600 transition-colors group-hover:bg-accent-500"></span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.about-nav')
@endsection
