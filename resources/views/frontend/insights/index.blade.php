@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Knowledge Hub"
        title="Engineering"
        title-accent="Insights"
        subtitle="Ideas, updates and expertise from our engineering teams."
        :breadcrumbs="[['name' => 'Insights']]"
    />

    <section class="bg-surface py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-10 lg:flex-row">

                <aside class="reveal-left w-full shrink-0 space-y-6 lg:w-64">
                    <form method="GET" action="{{ route('insights.index') }}">
                        <div class="relative">
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search articles..."
                                class="w-full rounded-xl border border-ink-200 bg-white py-3 pl-4 pr-10 text-sm outline-none focus:ring-2 focus:ring-accent-500">
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-ink-400 transition-colors hover:text-accent-600" aria-label="Search">
                                <x-icon name="arrow-long-right" class="h-4 w-4" />
                            </button>
                        </div>
                    </form>

                    <div class="rounded-2xl border border-ink-100 bg-white p-5">
                        <h2 class="eyebrow mb-4 text-ink-400">Categories</h2>
                        <div class="space-y-1">
                            <a href="{{ route('insights.index') }}"
                                class="block rounded-lg px-3 py-2 text-sm transition-colors {{ ! request('category') ? 'bg-accent-50 font-semibold text-accent-700' : 'text-ink-600 hover:bg-surface' }}">
                                All Posts
                            </a>
                            @foreach ($categories as $category)
                                <a href="{{ route('insights.category', $category->slug) }}"
                                    class="flex items-center justify-between rounded-lg px-3 py-2 text-sm text-ink-600 transition-colors hover:bg-surface">
                                    <span>{{ $category->name }}</span>
                                    <span class="rounded-full bg-ink-50 px-1.5 py-0.5 text-xs text-ink-400">{{ $category->blogs_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @if ($latestTags->count())
                        <div class="rounded-2xl border border-ink-100 bg-white p-5">
                            <h2 class="eyebrow mb-4 text-ink-400">Tags</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($latestTags as $tag)
                                    <a href="{{ route('insights.tag', $tag->slug) }}"
                                        class="rounded-full border border-ink-200 px-3 py-1.5 text-xs text-ink-600 transition-all hover:border-accent-400 hover:bg-accent-50 hover:text-accent-700">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>

                <div class="flex-1">
                    @if ($blogs->count())
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($blogs as $index => $blog)
                                @include('frontend.insights._card', ['blog' => $blog, 'delay' => ($index % 3) * 60])
                            @endforeach
                        </div>
                        <div class="mt-10">{{ $blogs->links() }}</div>
                    @else
                        <div class="rounded-2xl border border-ink-100 bg-white py-20 text-center">
                            <x-icon name="pencil-square" class="mx-auto mb-3 h-12 w-12 text-ink-200" />
                            <p class="text-ink-400">No articles found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
