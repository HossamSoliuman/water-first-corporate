@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Knowledge hub"
        title="Engineering"
        title-accent="insights"
        :breadcrumbs="[['name' => 'Insights']]"
    />

    <section class="bg-white py-14 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 border-b border-line pb-6 lg:flex-row lg:items-center lg:justify-between">
                <nav class="-mx-4 overflow-x-auto px-4 lg:mx-0 lg:px-0" aria-label="Insight categories">
                    <ul class="flex gap-2 whitespace-nowrap">
                        <li>
                            <a href="{{ route('insights.index') }}"
                                class="inline-flex rounded border px-3.5 py-2 text-sm font-medium transition-colors {{ ! request('category') ? 'border-primary-600 bg-primary-600 text-white' : 'border-ink-200 text-ink-700 hover:border-primary-600' }}">
                                All posts
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('insights.category', $category->slug) }}"
                                    class="inline-flex items-center gap-2 rounded border border-ink-200 px-3.5 py-2 text-sm font-medium text-ink-700 transition-colors hover:border-primary-600">
                                    {{ $category->name }}
                                    <span class="font-mono text-[11px] text-ink-400">{{ $category->blogs_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>

                <form method="GET" action="{{ route('insights.index') }}" class="relative w-full lg:w-72" role="search">
                    <label for="insight-search" class="sr-only">Search articles</label>
                    <input id="insight-search" type="search" name="search" value="{{ request('search') }}" placeholder="Search articles"
                        class="w-full rounded border border-ink-200 bg-white py-2.5 pl-4 pr-11 text-sm text-ink-800 outline-none transition focus:border-accent-500 focus:ring-2 focus:ring-accent-100">
                    <button type="submit" class="absolute right-1.5 top-1/2 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded text-ink-500 hover:text-primary-600" aria-label="Search">
                        <x-icon name="arrow-long-right" class="h-4 w-4" />
                    </button>
                </form>
            </div>

            @if ($latestTags->count())
                <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2">
                    <span class="font-mono text-[11px] uppercase tracking-[.14em] text-ink-500">Tags</span>
                    @foreach ($latestTags as $tag)
                        <a href="{{ route('insights.tag', $tag->slug) }}" class="font-mono text-xs text-primary-600 hover:underline">#{{ $tag->name }}</a>
                    @endforeach
                </div>
            @endif

            @if ($blogs->count())
                <div class="mt-12 grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($blogs as $index => $blog)
                        @include('frontend.insights._card', ['blog' => $blog, 'delay' => ($index % 3) * 60])
                    @endforeach
                </div>
                <div class="mt-12">{{ $blogs->links() }}</div>
            @else
                <div class="mt-12 rounded bg-surface px-6 py-16 text-center">
                    <p class="text-lg text-ink-600">No articles match your search.</p>
                    <a href="{{ route('insights.index') }}" class="mt-4 inline-block text-sm font-semibold text-primary-600 hover:underline">Show all articles</a>
                </div>
            @endif
        </div>
    </section>
@endsection
