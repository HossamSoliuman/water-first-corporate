@php($delay = $delay ?? 0)

<a href="{{ route('insights.show', $blog->slug) }}"
    class="wf-card group reveal flex flex-col overflow-hidden"
    style="transition-delay: {{ $delay }}ms">
    <div class="media-frame aspect-[16/9] overflow-hidden rounded-t-2xl">
        @if ($blog->featured_image)
            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" loading="lazy" decoding="async"
                class="h-full w-full object-cover">
        @else
            <div class="h-full w-full bg-gradient-to-br from-primary-900 to-accent-800"></div>
        @endif
    </div>

    <div class="flex flex-1 flex-col p-6">
        @if ($blog->category)
            <span class="mb-3 text-xs font-semibold uppercase tracking-widest text-secondary-500">{{ $blog->category->name }}</span>
        @endif

        <h3 class="mb-3 flex-1 font-heading text-lg leading-snug text-ink-900 transition-colors group-hover:text-accent-600">{{ $blog->title }}</h3>

        @if ($blog->excerpt)
            <p class="mb-4 line-clamp-2 text-sm text-ink-400">{{ $blog->excerpt }}</p>
        @endif

        <div class="flex items-center justify-between border-t border-ink-100 pt-3 text-xs text-ink-400">
            <div class="flex items-center gap-1.5">
                @if ($blog->author)<span>{{ $blog->author->name }}</span><span>·</span>@endif
                <span>{{ $blog->published_at?->format('M d, Y') }}</span>
            </div>
            <span>{{ $blog->reading_time }} min read</span>
        </div>
    </div>
</a>
