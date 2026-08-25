@php($delay = $delay ?? 0)

<a href="{{ route('case-studies.show', $cs->slug) }}"
    class="wf-card group reveal flex flex-col overflow-hidden"
    style="transition-delay: {{ $delay }}ms">
    <div class="media-frame aspect-[4/3] overflow-hidden rounded-t-2xl">
        @if ($cs->featured_image)
            <img src="{{ asset($cs->featured_image) }}" alt="{{ $cs->title }}" loading="lazy" decoding="async"
                class="h-full w-full object-cover">
        @else
            <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-primary-900 to-accent-800">
                <x-icon name="{{ $cs->industry->icon ?? 'building-office-2' }}" class="h-12 w-12 text-white/30" />
            </div>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-6">
        <div class="mb-3 flex flex-wrap items-center gap-2">
            @if ($cs->industry)
                <span class="text-xs font-semibold uppercase tracking-widest text-secondary-500">{{ $cs->industry->name }}</span>
            @endif
            @if ($cs->category)
                <span class="text-xs text-ink-400">· {{ $cs->category->name }}</span>
            @endif
        </div>

        <h3 class="flex-1 font-heading text-lg leading-snug text-ink-900 transition-colors group-hover:text-accent-600">{{ $cs->title }}</h3>

        @if ($cs->client_name)
            <p class="mt-2 text-xs text-ink-400">{{ $cs->client_name }}</p>
        @endif

        <div class="mt-4 flex items-center gap-2 text-xs font-semibold text-accent-600 transition-all group-hover:gap-3">
            View Case Study <x-icon name="arrow-long-right" class="h-4 w-4" />
        </div>
    </div>
</a>
