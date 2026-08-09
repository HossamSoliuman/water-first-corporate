@if ($cards->count())
    <section class="border-y border-ink-200 bg-surface py-20">
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
                    </div>
                </div>
                <div class="grid gap-5 sm:grid-cols-2 {{ ($gridCols ?? 4) === 3 ? 'xl:grid-cols-3' : '' }} lg:col-span-9">
                    @foreach ($cards as $index => $card)
                        <article class="wf-card p-6 reveal">
                            <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            @if ($card->image)
                                <img src="{{ asset($card->image) }}" alt="{{ $card->title }}" class="mt-5 aspect-[4/3] w-full object-cover" loading="lazy">
                            @endif
                            <h3 class="mt-7 text-lg font-semibold leading-snug text-ink-800">{{ $card->title }}</h3>
                            @if ($card->description)
                                <p class="mt-3 text-sm leading-6 text-ink-500">{{ $card->description }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
