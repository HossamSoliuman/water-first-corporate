@extends('layouts.app')

@section('content')
    <x-page-hero
        :eyebrow="$blog->category?->name"
        :title="$blog->title"
        size="compact"
        :breadcrumbs="[['name' => 'Insights', 'url' => route('insights.index')], ['name' => $blog->title]]"
    >
        <p class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-2 border-t border-line pt-5 font-mono text-xs text-ink-500">
            @if ($blog->author)<span class="font-medium text-ink-900">{{ $blog->author->name }}</span>@endif
            <span>{{ $blog->published_at?->format('d M Y') }}</span>
            <span>{{ $blog->reading_time }} min read</span>
        </p>
    </x-page-hero>

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12">
                <article class="reveal lg:col-span-8">
                    @if ($blog->featured_image)
                        <div class="media-frame mb-10 aspect-video rounded">
                            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="h-full w-full object-cover">
                        </div>
                    @endif

                    <div class="prose prose-lg max-w-none">{!! $blog->content !!}</div>

                    @if ($blog->tags->count())
                        <div class="mt-10 flex flex-wrap gap-x-4 gap-y-2 border-t border-line pt-6">
                            @foreach ($blog->tags as $tag)
                                <a href="{{ route('insights.tag', $tag->slug) }}" class="font-mono text-xs text-primary-600 hover:underline">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </article>

                <aside class="lg:col-span-4">
                    <div class="space-y-10 lg:sticky lg:top-32">
                        <div class="border-t-2 border-primary-600 pt-6">
                            <h2 class="text-xl font-semibold text-ink-900">Discuss a project</h2>
                            <p class="mt-3 text-sm leading-6 text-ink-600">Speak with our engineering team about your infrastructure needs.</p>
                            <a href="{{ route('contact') }}" class="wf-btn-primary group mt-6 w-full">
                                Contact {{ $settings->get('site_name', 'WaterFirst') }} <x-icon name="arrow-long-right" class="arrow-nudge h-4 w-4" />
                            </a>
                        </div>

                        @if ($related->count())
                            <div>
                                <h2 class="font-mono text-[11px] font-medium uppercase tracking-[.14em] text-ink-500">Related articles</h2>
                                <div class="mt-4 border-t border-line">
                                    @foreach ($related as $relatedBlog)
                                        <a href="{{ route('insights.show', $relatedBlog->slug) }}" class="group flex gap-4 border-b border-line py-4">
                                            @if ($relatedBlog->featured_image)
                                                <img src="{{ asset($relatedBlog->featured_image) }}" alt="" class="h-16 w-20 shrink-0 rounded object-cover">
                                            @endif
                                            <div>
                                                <p class="text-sm font-semibold leading-snug text-ink-900 group-hover:text-primary-600">{{ $relatedBlog->title }}</p>
                                                <p class="mt-1 font-mono text-[11px] text-ink-500">{{ $relatedBlog->published_at?->format('d M Y') }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
