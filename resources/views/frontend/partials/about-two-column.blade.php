@if (($sec['intro_heading'] ?? '') || ($sec['intro_body'] ?? '') || ($sec['side_image'] ?? ''))
    @php
        $highlights = $highlights ?? [];
        $stats = $stats ?? [];
    @endphp
    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 xl:grid-cols-5">
                <div class="reveal-left xl:col-span-3 {{ count($stats) ? 'xl:flex xl:flex-col' : '' }}">
                    @if ($sec['intro_heading'] ?? '')
                        <h2 class="text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">{{ $sec['intro_heading'] }}</h2>
                    @endif
                    @if ($sec['intro_body'] ?? '')
                        <div class="technical-rule mt-7 grid gap-5 pl-6 text-base leading-8 text-ink-500">
                            @foreach (preg_split('/\r\n\r\n|\n\n/', trim($sec['intro_body'])) as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (count($highlights))
                        <div class="mt-10 grid gap-px border border-ink-200 bg-ink-200 {{ count($stats) ? 'xl:grow' : '' }}">
                            @foreach ($highlights as $index => [$icon, $label, $detail])
                                <div class="hover-row group flex items-start gap-4 bg-white p-5 reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index % 4] }}">
                                    <span class="icon-tile h-10 w-10"><x-icon name="{{ $icon }}" class="h-4 w-4" /></span>
                                    <span>
                                        <span class="block font-mono text-[10px] uppercase tracking-[.16em] text-primary-600">{{ $label }}</span>
                                        <span class="mt-1.5 block text-sm leading-6 text-ink-500">{{ $detail }}</span>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="reveal-right flex flex-col xl:col-span-2">
                    @if ($sec['side_image'] ?? '')
                        <figure class="media-frame group relative border border-ink-200">
                            <img src="{{ asset($sec['side_image']) }}" alt="{{ $page->title }}" class="aspect-[4/5] w-full object-cover" loading="lazy" decoding="async">
                            <div class="media-tint absolute inset-0"></div>
                            <span class="icon-tile icon-tile-dark absolute left-4 top-4 h-10 w-10 backdrop-blur-sm"><x-icon name="droplet" class="h-4 w-4" /></span>
                        </figure>
                    @else
                        <div class="technical-rule bg-surface p-7">
                            <div class="flex items-center justify-between">
                                <p class="font-mono text-xs uppercase tracking-[.16em] text-primary-600">WaterFirst standard</p>
                                <span class="pulse-node h-1.5 w-1.5 rounded-full bg-accent-500"></span>
                            </div>

                            <svg class="mt-7 w-full text-accent-500" viewBox="0 0 240 96" fill="none" aria-hidden="true">
                                <g stroke="currentColor" stroke-opacity=".3" stroke-width="1">
                                    <path d="M0 24h240M0 48h240M0 72h240"/>
                                </g>
                                <path class="flow-stroke" d="M0 48c40-30 80 30 120 0s80-30 120 0" stroke="currentColor" stroke-width="2"/>
                                <path class="flow-stroke-slow" d="M0 66c40-30 80 30 120 0s80-30 120 0" stroke="currentColor" stroke-width="1.5" stroke-opacity=".6"/>
                                <circle class="pulse-node" cx="60" cy="33" r="3.5" fill="currentColor"/>
                                <circle class="pulse-node" style="animation-delay:1.2s" cx="180" cy="63" r="3.5" fill="currentColor"/>
                            </svg>

                            <p class="mt-7 font-heading text-xl font-medium leading-8 text-ink-800">Practical engineering, direct collaboration and accountable delivery.</p>
                        </div>
                    @endif

                    @if (count($stats))
                        <div class="hidden grow xl:block"></div>
                        <div class="mt-5 grid grid-cols-2 gap-px border border-ink-200 bg-ink-200 sm:grid-cols-4">
                            @foreach ($stats as $index => [$icon, $value, $unit, $countTo, $label])
                                <div class="group bg-white px-4 py-5 reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index % 4] }}">
                                    <span class="icon-tile h-9 w-9"><x-icon name="{{ $icon }}" class="h-4 w-4" /></span>
                                    <p class="metric mt-4 text-xl font-semibold leading-none sm:text-2xl">
                                        @if ($countTo)
                                            <span data-count-to="{{ $countTo }}">{{ $value }}</span>{{ $unit }}
                                        @else
                                            {{ $value }}{{ $unit }}
                                        @endif
                                    </p>
                                    <p class="mt-2 text-[11px] leading-[1.45] text-ink-500">{{ $label }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif
