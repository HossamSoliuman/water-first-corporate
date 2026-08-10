@if ($cards->count())
    @php
        $cardIcons = $cardIcons ?? [];
        $cardDelays = ['', 'delay-100', 'delay-200', 'delay-300', 'delay-400', 'delay-500'];
    @endphp
    <section class="border-y border-ink-200 bg-surface py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3">
                    <div class="sticky-label">
                        @if (! empty($cardsLabel ?? ''))
                            <p class="section-kicker">03 — {{ $cardsLabel }}</p>
                        @endif
                        @if (! empty($cardsHeading ?? ''))
                            <h2 class="mt-6 text-3xl font-semibold leading-tight text-ink-800">{{ $cardsHeading }}</h2>
                        @endif
                        <p class="mt-7 flex items-center gap-3 font-mono text-[10px] uppercase tracking-[.16em] text-ink-500">
                            <span class="pulse-node h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                            {{ str_pad($cards->count(), 2, '0', STR_PAD_LEFT) }} — {{ $cardsCountLabel ?? 'points' }}
                        </p>

                        <svg class="mt-8 hidden w-full max-w-[13rem] text-accent-500 lg:block" viewBox="0 0 220 60" fill="none" aria-hidden="true">
                            <path class="draw-stroke" d="M4 40c30-34 56 22 84-8s54 24 82-10" stroke="currentColor" stroke-width="1.25" stroke-opacity=".5"/>
                            <path class="flow-stroke" d="M4 40c30-34 56 22 84-8s54 24 82-10" stroke="currentColor" stroke-width="1.75"/>
                            <circle class="pulse-node" cx="88" cy="32" r="3.5" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
                <div class="grid gap-5 sm:grid-cols-2 {{ ($gridCols ?? 4) === 3 ? 'xl:grid-cols-3' : '' }} lg:col-span-9">
                    @foreach ($cards as $index => $card)
                        <article class="wf-card group flex flex-col p-7 reveal {{ $cardDelays[$index % 6] }}">
                            <div class="flex items-start justify-between gap-4">
                                <span class="icon-tile h-12 w-12">
                                    <x-icon name="{{ $cardIcons[$index] ?? 'check-circle' }}" class="h-5 w-5" />
                                </span>
                                <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            @if ($card->image)
                                <div class="media-frame mt-6 border border-ink-200">
                                    <img src="{{ asset($card->image) }}" alt="{{ $card->title }}" class="aspect-[4/3] w-full object-cover" loading="lazy" decoding="async">
                                </div>
                            @endif

                            <h3 class="mt-7 font-heading text-lg font-semibold leading-snug text-ink-800 group-hover:text-primary-600">
                                <span class="underline-grow">{{ $card->title }}</span>
                            </h3>
                            @if ($card->description)
                                <p class="mt-3 flex-1 text-sm leading-6 text-ink-500">{{ $card->description }}</p>
                            @endif

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
@endif
