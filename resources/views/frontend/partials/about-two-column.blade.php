@if (($sec['intro_heading'] ?? '') || ($sec['intro_body'] ?? '') || ($sec['side_image'] ?? ''))
    <section class="bg-white py-20">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <div class="lg:col-span-3">
                <div class="sticky-label">
                    <p class="section-kicker">02 — {{ $sec['intro_label'] ?? 'Overview' }}</p>
                </div>
            </div>
            <div class="grid gap-10 lg:col-span-9 xl:grid-cols-5">
                <div class="reveal-left xl:col-span-3">
                    @if ($sec['intro_heading'] ?? '')
                        <h2 class="text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">{{ $sec['intro_heading'] }}</h2>
                    @endif
                    @if ($sec['intro_body'] ?? '')
                        <div class="mt-7 grid gap-5 text-base leading-8 text-ink-500">
                            @foreach (preg_split('/\r\n\r\n|\n\n/', trim($sec['intro_body'])) as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="reveal-right xl:col-span-2">
                    @if ($sec['side_image'] ?? '')
                        <img src="{{ asset($sec['side_image']) }}" alt="{{ $page->title }}" class="aspect-[4/5] w-full border border-ink-200 object-cover" loading="lazy">
                    @else
                        <div class="technical-rule bg-surface p-7">
                            <p class="font-mono text-xs uppercase tracking-[.16em] text-primary-600">WaterFirst standard</p>
                            <p class="mt-5 font-heading text-xl font-medium leading-8 text-ink-800">Practical engineering, direct collaboration and accountable delivery.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
