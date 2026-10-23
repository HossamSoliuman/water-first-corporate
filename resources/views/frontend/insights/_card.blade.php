@php($delay = $delay ?? 0)

<a href="{{ route('insights.show', $blog->slug) }}"
    class="group reveal flex flex-col"
    style="transition-delay: {{ $delay }}ms">
    <div class="media-frame aspect-[16/10] rounded">
        @if ($blog->featured_image)
            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" loading="lazy" decoding="async" class="h-full w-full object-cover">
        @else
            <div class="flow-lines h-full w-full bg-surface"></div>
        @endif
    </div>

    <div class="flex flex-1 flex-col border-b border-line pb-6 pt-5">
        <p class="flex flex-wrap items-center gap-x-3 font-mono text-[11px] uppercase tracking-[.12em] text-ink-500">
            <span>{{ $blog->published_at?->format('d M Y') }}</span>
            @if ($blog->category)
                <span class="text-accent-700">{{ $blog->category->name }}</span>
            @endif
        </p>

        <h3 class="mt-3 text-lg font-semibold leading-snug text-ink-900">
            <span class="underline-grow">{{ $blog->title }}</span>
        </h3>

        @if ($blog->excerpt)
            <p class="mt-3 line-clamp-2 flex-1 text-sm leading-6 text-ink-600">{{ $blog->excerpt }}</p>
        @endif

        <p class="mt-4 font-mono text-[11px] text-ink-500">
            @if ($blog->author){{ $blog->author->name }} · @endif{{ $blog->reading_time }} min read
        </p>
    </div>
</a>
