@extends('layouts.app')

@section('content')
    @php
        $sec = $page->sections ?? [];
        $heroChips = $sec['hero_chips'] ?? [];
        $highlights = collect($sec['highlights'] ?? [])
            ->map(fn (array $row): array => [$row['icon'] ?? 'check-circle', $row['label'] ?? '', $row['detail'] ?? ''])
            ->all();
        $cardMeta = collect($sec['card_meta'] ?? [])->mapWithKeys(fn ($meta, $id) => [(int) $id => $meta])->all();
        $benefits = $sec['benefits'] ?? [];
        $stages = $sec['stages'] ?? [];
        $rowDelays = ['', 'delay-100', 'delay-200', 'delay-300', 'delay-400', 'delay-500'];
    @endphp

    <section class="interior-hero flow-lines py-10 md:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'About', 'url' => route('company-overview')], ['name' => $page->title]]" />
            <div class="mt-6 grid gap-x-8 gap-y-5 lg:grid-cols-12">
                <div class="lg:col-span-12">
                    <h1 class="reveal delay-100 text-[clamp(1.75rem,3.6vw,3rem)] font-semibold leading-[1.05] text-ink-800">{{ $page->title }}</h1>
                    @if ($page->subtitle)
                        <p class="reveal delay-200 mt-5 max-w-3xl text-lg leading-8 text-ink-500">{{ $page->subtitle }}</p>
                    @endif

                    @if (count($heroChips))
                        <div class="reveal delay-300 mt-8 flex flex-wrap gap-x-8 gap-y-4 border-t border-ink-200 pt-6">
                            @foreach ($heroChips as $chip)
                                <span class="group flex items-center gap-3">
                                    <span class="icon-tile h-9 w-9"><x-icon name="{{ $chip['icon'] ?? 'check-circle' }}" class="h-4 w-4" /></span>
                                    <span class="font-mono text-[10px] uppercase tracking-[.16em] text-ink-500">{{ $chip['label'] ?? '' }}</span>
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.about-two-column', [
        'sec' => $sec,
        'introIcon' => 'scale',
        'highlights' => $highlights,
    ])

    @include('frontend.partials.about-cards', [
        'cards' => $cards,
        'cardsHeading' => $sec['cards_heading'] ?? 'Engagement models',
        'cardsBody' => $sec['cards_body'] ?? null,
        'cardsCountLabel' => 'models',
        'cardMeta' => $cardMeta,
        'gridCols' => 3,
    ])

    @if (count($benefits))
        <section class="bg-white py-16 md:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-10 lg:grid-cols-12">
                    <div class="reveal-left lg:col-span-4">
                        @if ($sec['benefits_heading'] ?? '')
                            <h2 class="text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">{{ $sec['benefits_heading'] }}</h2>
                        @endif
                        @if ($sec['benefits_body'] ?? '')
                            <p class="mt-6 max-w-lg text-base leading-7 text-ink-500">{{ $sec['benefits_body'] }}</p>
                        @endif
                        @if ($sec['benefits_footnote'] ?? '')
                            <p class="technical-rule mt-8 pl-6 font-heading text-xl font-medium leading-8 text-ink-800">{{ $sec['benefits_footnote'] }}</p>
                        @endif
                    </div>

                    <div class="grid gap-px border border-ink-200 bg-ink-200 sm:grid-cols-2 lg:col-span-8 xl:grid-cols-3">
                        @foreach ($benefits as $index => $benefit)
                            <div class="hover-row group flex flex-col bg-white p-6 reveal {{ $rowDelays[$index % 6] }}">
                                <span class="icon-tile h-11 w-11"><x-icon name="{{ $benefit['icon'] ?? 'check-circle' }}" class="h-5 w-5" /></span>
                                <p class="mt-6 font-heading text-base font-medium leading-6 text-ink-800">{{ $benefit['label'] ?? '' }}</p>
                                <p class="mt-2 text-sm leading-6 text-ink-500">{{ $benefit['detail'] ?? '' }}</p>
                            </div>
                        @endforeach

                        {{-- The gap-px background shows through unfilled cells, so pad the last row out. --}}
                        @for ($filler = 0; $filler < (6 - count($benefits) % 6) % 6; $filler++)
                            <div class="hidden bg-white sm:block"></div>
                        @endfor
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (count($stages))
        <section class="border-t border-ink-200 bg-surface py-16 md:py-20">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-12">
                    <div class="reveal-left lg:col-span-4">
                        @if ($sec['stages_heading'] ?? '')
                            <h2 class="text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">{{ $sec['stages_heading'] }}</h2>
                        @endif
                        @if ($sec['stages_body'] ?? '')
                            <p class="mt-6 max-w-lg text-base leading-7 text-ink-500">{{ $sec['stages_body'] }}</p>
                        @endif

                        <a href="{{ route('contact') }}" class="wf-btn-primary group mt-8">
                            {{ $sec['stages_cta'] ?? 'Discuss your project' }} <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                        </a>
                    </div>

                    <div class="lg:col-span-8">
                        @foreach ($stages as $index => $stage)
                            <div class="hover-row group grid grid-cols-[2rem_2.75rem_1fr_auto] items-center gap-4 border-t border-ink-200 py-5 last:border-b reveal {{ $rowDelays[$index % 6] }}">
                                <span class="font-mono text-xs text-accent-600">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="icon-tile h-11 w-11"><x-icon name="{{ $stage['icon'] ?? 'check-circle' }}" class="h-5 w-5" /></span>
                                <span>
                                    <span class="block font-heading text-base font-medium text-ink-800 md:text-lg">{{ $stage['title'] ?? '' }}</span>
                                    <span class="mt-1 block text-sm leading-6 text-ink-500">{{ $stage['detail'] ?? '' }}</span>
                                </span>
                                <span class="h-2 w-2 border border-accent-600 transition-colors group-hover:bg-accent-500"></span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (($sec['closing_heading'] ?? '') || ($sec['closing_body'] ?? ''))
        <section class="flow-lines bg-primary-600 py-14 text-white md:py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid gap-8 lg:grid-cols-12 lg:items-end">
                    <div class="reveal-left lg:col-span-7">
                        @if ($sec['closing_heading'] ?? '')
                            <h2 class="text-3xl font-semibold leading-tight text-white md:text-4xl">{{ $sec['closing_heading'] }}</h2>
                        @endif
                        @if ($sec['closing_body'] ?? '')
                            <p class="mt-6 max-w-2xl text-base leading-7 text-primary-100">{{ $sec['closing_body'] }}</p>
                        @endif
                    </div>
                    <div class="reveal-right lg:col-span-5 lg:text-right">
                        <a href="{{ route('contact') }}" class="wf-btn-light sheen group">
                            Talk to our engineers <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
