@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden bg-primary-950 wf-texture py-28">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-950 via-primary-900/95 to-accent-950/40"></div>
        <div class="relative z-10 mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'Insights', 'url' => route('insights.index')], ['name' => $blog->title]]" light />

            @if ($blog->category)
                <a href="{{ route('insights.category', $blog->category->slug) }}"
                    class="mt-6 inline-block text-xs font-semibold uppercase tracking-widest text-accent-300 transition-colors hover:text-white">
                    {{ $blog->category->name }}
                </a>
            @endif

            <h1 class="mb-6 mt-3 font-heading text-4xl leading-tight text-white md:text-5xl">{{ $blog->title }}</h1>

            <div class="flex flex-wrap items-center gap-3 text-sm text-primary-300">
                @if ($blog->author)<span class="font-medium text-primary-100">{{ $blog->author->name }}</span><span>·</span>@endif
                <span>{{ $blog->published_at?->format('M d, Y') }}</span>
                <span>·</span>
                <span>{{ $blog->reading_time }} min read</span>
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-3">
                <article class="reveal-left lg:col-span-2">
                    @if ($blog->featured_image)
                        <div class="media-frame mb-8 aspect-video overflow-hidden rounded-2xl">
                            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="h-full w-full object-cover">
                        </div>
                    @endif

                    <div class="prose prose-lg max-w-none">{!! $blog->content !!}</div>

                    @if ($blog->tags->count())
                        <div class="mt-8 flex flex-wrap gap-2">
                            @foreach ($blog->tags as $tag)
                                <a href="{{ route('insights.tag', $tag->slug) }}"
                                    class="rounded-full bg-accent-50 px-3 py-1.5 text-xs font-medium text-accent-700 transition-colors hover:bg-accent-100">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </article>

                <aside class="reveal-right space-y-6">
                    <div class="wf-panel p-6">
                        <h2 class="mb-3 font-heading text-lg text-white">Discuss a Project</h2>
                        <p class="mb-5 text-sm text-primary-200">
                            Speak with our engineering team about your infrastructure needs.
                        </p>
                        <a href="{{ route('contact') }}" class="wf-btn-primary w-full py-3 text-sm">
                            Contact {{ $settings->get('site_name', 'WaterFirst') }}
                        </a>
                    </div>

                    @if ($related->count())
                        <div class="wf-panel p-6">
                            <h2 class="mb-4 text-sm font-semibold text-white">Related Articles</h2>
                            <div class="space-y-4">
                                @foreach ($related as $relatedBlog)
                                    <a href="{{ route('insights.show', $relatedBlog->slug) }}" class="group/item flex gap-3">
                                        @if ($relatedBlog->featured_image)
                                            <img src="{{ asset($relatedBlog->featured_image) }}" alt="{{ $relatedBlog->title }}" class="h-16 w-16 shrink-0 rounded-xl object-cover">
                                        @endif
                                        <div>
                                            <p class="text-sm font-medium leading-snug text-primary-100 transition-colors group-hover/item:text-accent-300">{{ $relatedBlog->title }}</p>
                                            <p class="mt-1 text-xs text-primary-300">{{ $relatedBlog->published_at?->format('M d, Y') }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
