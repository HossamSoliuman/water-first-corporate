@php($delay = $delay ?? 0)

<a href="{{ route('case-studies.show', $cs->slug) }}"
    class="group reveal flex flex-col"
    style="transition-delay: {{ $delay }}ms">
    <div class="media-frame relative aspect-[4/3] rounded">
        @if ($cs->featured_image)
            <img src="{{ asset($cs->featured_image) }}" alt="{{ $cs->title }}" loading="lazy" decoding="async" class="h-full w-full object-cover">
        @else
            <div class="flow-lines flex h-full w-full items-center justify-center bg-surface">
                <x-icon name="{{ $cs->industry->icon ?? 'building-office-2' }}" class="h-10 w-10 text-ink-300" />
            </div>
        @endif
        <span class="absolute bottom-3 right-3 flex h-10 w-10 items-center justify-center rounded bg-white text-ink-900 opacity-0 transition-opacity group-hover:opacity-100">
            <x-icon name="arrow-long-right" class="h-5 w-5" />
        </span>
    </div>

    <div class="flex flex-1 flex-col border-b border-line pb-6 pt-5">
        @if ($cs->industry || $cs->category)
            <p class="font-mono text-[11px] uppercase tracking-[.12em] text-accent-700">
                {{ collect([$cs->industry?->name, $cs->category?->name])->filter()->implode(' / ') }}
            </p>
        @endif

        <h3 class="mt-3 text-lg font-semibold leading-snug text-ink-900">
            <span class="underline-grow">{{ $cs->title }}</span>
        </h3>

        @if ($cs->client_name)
            <p class="mt-3 text-sm text-ink-500">{{ $cs->client_name }}</p>
        @endif
    </div>
</a>
