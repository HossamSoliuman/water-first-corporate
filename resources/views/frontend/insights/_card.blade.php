@php($delay = $delay ?? 0)
<a href="{{ route('insights.show', $blog->slug) }}" class="wf-card group flex flex-col overflow-hidden reveal" style="transition-delay: {{ $delay }}ms">
    @if ($blog->featured_image)
        <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="aspect-video w-full border-b border-ink-200 object-cover" loading="lazy">
    @else
        <div class="aspect-video border-b border-ink-200 bg-primary-50 flow-lines"></div>
    @endif
    <div class="flex flex-1 flex-col p-6">
        @if ($blog->category)<span class="font-mono text-[9px] uppercase tracking-[.14em] text-primary-600">{{ $blog->category->name }}</span>@endif
        <h2 class="mt-4 flex-1 text-lg font-semibold leading-snug text-ink-800 group-hover:text-primary-600">{{ $blog->title }}</h2>
        @if ($blog->excerpt)<p class="mt-3 text-sm leading-6 text-ink-500 line-clamp-2">{{ $blog->excerpt }}</p>@endif
        <div class="mt-5 flex items-center justify-between border-t border-ink-100 pt-4 font-mono text-[9px] uppercase tracking-wider text-ink-400"><span>{{ $blog->published_at?->format('d M Y') }}</span><span>{{ $blog->reading_time }} min</span></div>
    </div>
</a>
