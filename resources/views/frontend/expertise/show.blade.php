@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-10 md:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'Expertise', 'url' => route('expertise.index')], ['name' => $service->name]]" />
            <div class="mt-6">
                <h1 class="text-[clamp(1.75rem,3.6vw,3rem)] font-semibold leading-[1.08] text-ink-800">{{ $service->name }}</h1>
                <p class="mt-6 max-w-3xl text-lg leading-8 text-ink-500">{{ $service->short_description }}</p>
            </div>
        </div>
    </section>

    <section class="bg-white py-14 md:py-16">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <article class="lg:col-span-8 reveal-left">
                @if ($service->featured_image)
                    <figure class="group relative mb-9 reveal-scale delay-100">
                        <span aria-hidden="true" class="pointer-events-none absolute -left-3 -top-3 hidden h-20 w-20 border-l-2 border-t-2 border-accent-500 transition-all duration-500 ease-out group-hover:-left-4 group-hover:-top-4 sm:block"></span>
                        <span aria-hidden="true" class="pointer-events-none absolute -bottom-3 -right-3 hidden h-20 w-20 border-b-2 border-r-2 border-accent-500 transition-all duration-500 ease-out group-hover:-bottom-4 group-hover:-right-4 sm:block"></span>
                        <div class="media-frame sheen relative aspect-video w-full border border-ink-200">
                            <img src="{{ asset($service->featured_image) }}" alt="{{ $service->name }}" class="h-full w-full object-cover">
                            <span aria-hidden="true" class="media-tint absolute inset-0"></span>
                            <span aria-hidden="true" class="media-veil absolute inset-x-0 bottom-0 h-2/5"></span>
                            <figcaption class="absolute inset-x-0 bottom-0 flex items-center gap-3 p-4 sm:p-5">
                                <span class="h-1.5 w-1.5 shrink-0 bg-accent-400"></span>
                                <span class="font-mono text-[10px] uppercase tracking-[.16em] text-white/90">{{ $service->name }}</span>
                            </figcaption>
                        </div>
                    </figure>
                @endif
                <div class="prose prose-lg max-w-none prose-headings:font-heading prose-headings:text-ink-800 prose-li:marker:text-accent-600">{!! $service->description !!}</div>
            </article>
            <aside class="space-y-5 lg:col-span-4 reveal-right">
                <div class="technical-rule bg-surface p-6">
                    <h2 class="text-xl font-semibold text-ink-800">Start a project</h2>
                    <p class="mt-3 text-sm leading-6 text-ink-500">Share the source water, discharge challenge or delivery scope. We will frame the right technical response.</p>
                    <a href="{{ route('contact') }}" class="wf-btn-primary mt-6 w-full">Get in touch</a>
                </div>

                @if ($related->count())
                    <div class="border border-ink-200 bg-white p-6">
                        <h2 class="font-mono text-[10px] uppercase tracking-[.16em] text-primary-600">Related expertise</h2>
                        <div class="mt-4 grid">
                            @foreach ($related as $relatedService)
                                <a href="{{ route('expertise.show', $relatedService->slug) }}" class="hover-row group flex items-center gap-3 border-t border-ink-100 px-2 py-3 text-sm font-medium leading-snug text-ink-700 hover:text-primary-600">
                                    <span class="h-1.5 w-1.5 shrink-0 bg-accent-500"></span>
                                    <span class="underline-grow">{{ $relatedService->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @php
                    $youtubeId = null;
                    if ($service->youtube_url) {
                        preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/))([\w-]{11})~', $service->youtube_url, $matches);
                        $youtubeId = $matches[1] ?? null;
                    }
                @endphp
                @if ($youtubeId)
                    <iframe class="aspect-video w-full border border-ink-200" src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}" title="{{ $service->name }} video" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                @endif
            </aside>
        </div>
    </section>
@endsection
