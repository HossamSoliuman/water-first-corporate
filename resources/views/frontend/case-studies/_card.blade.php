@php($index = $index ?? null)
<a href="{{ route('case-studies.show', $cs->slug) }}" class="wf-card group flex flex-col overflow-hidden reveal">
    <div class="media-frame relative aspect-[4/3] w-full border-b border-ink-200">
        @if ($cs->featured_image)
            <img src="{{ asset($cs->featured_image) }}" alt="{{ $cs->title }}" class="h-full w-full object-cover" loading="lazy" decoding="async">
            <div class="media-tint absolute inset-0"></div>
        @else
            <div class="flow-lines flex h-full w-full items-center justify-center bg-primary-50">
                <svg viewBox="0 0 240 180" class="absolute inset-0 h-full w-full text-primary-200" fill="none" aria-hidden="true">
                    <path class="flow-stroke-slow" d="M-10 118c40-30 70 22 110-4s60 18 100-10 50-6 50-6" stroke="currentColor" stroke-width="1.5"/>
                    <path class="flow-stroke-slow" style="animation-delay:1.4s" d="M-10 142c44-30 66 20 106-6s64 20 104-8 50-4 50-4" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <span class="icon-tile icon-tile-solid relative h-16 w-16">
                    <x-icon name="{{ $cs->industry->icon ?? 'building-office-2' }}" class="h-7 w-7" />
                </span>
            </div>
        @endif
        @if ($index)
            <span class="absolute right-4 top-4 font-mono text-xs font-semibold tracking-[.12em] text-primary-600">{{ str_pad($index, 2, '0', STR_PAD_LEFT) }}</span>
        @endif
    </div>
    <div class="flex flex-1 flex-col p-6">
        @if ($cs->industry)
            <span class="flex items-center gap-2 font-mono text-[9px] uppercase tracking-[.14em] text-primary-600">
                <x-icon name="tag" class="h-3.5 w-3.5 text-accent-500" />{{ $cs->industry->name }}
            </span>
        @endif
        <h2 class="mt-5 flex-1 text-lg font-semibold leading-snug text-ink-800 group-hover:text-primary-600"><span class="font-metric">{{ $cs->title }}</span></h2>
        @if ($cs->client_name)<p class="mt-4 border-t border-ink-100 pt-4 text-xs leading-5 text-ink-500"><span class="font-semibold text-ink-700">Client / partner</span><br>{{ $cs->client_name }}</p>@endif
        <div class="mt-5 flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-primary-600">Project detail <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" /></div>
    </div>
</a>
