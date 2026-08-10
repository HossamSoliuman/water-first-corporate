@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-10 md:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'Expertise', 'url' => route('expertise.index')], ['name' => $service->name]]" />
            <div class="mt-6 grid gap-x-8 gap-y-5 lg:grid-cols-12">
                <div class="lg:col-span-12">
                    <span class="flex h-14 w-14 items-center justify-center border border-accent-500 text-accent-600"><x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-7 w-7" /></span>
                </div>
                <div class="lg:col-span-12">
                    <h1 class="text-[clamp(1.75rem,3.6vw,3rem)] font-semibold leading-[1.08] text-ink-800">{{ $service->name }}</h1>
                    <p class="mt-6 max-w-3xl text-lg leading-8 text-ink-500">{{ $service->short_description }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-14 md:py-16">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <aside class="lg:col-span-3">
                <div class="sticky-label">
                    <div class="border-t border-ink-200 pt-6">
                        <p class="font-mono text-[10px] uppercase tracking-[.14em] text-ink-500">Delivery base</p>
                        <p class="mt-2 text-sm font-semibold text-ink-800">Bangalore · India</p>
                    </div>
                </div>
            </aside>
            <article class="lg:col-span-6 reveal-left">
                @if ($service->featured_image)
                    <img src="{{ asset($service->featured_image) }}" alt="{{ $service->name }}" class="mb-9 aspect-video w-full border border-ink-200 object-cover">
                @endif
                <div class="prose prose-lg max-w-none prose-headings:font-heading prose-headings:text-ink-800 prose-li:marker:text-accent-600">{!! $service->description !!}</div>
            </article>
            <aside class="space-y-5 lg:col-span-3 reveal-right">
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
                                <a href="{{ route('expertise.show', $relatedService->slug) }}" class="flex items-center gap-3 border-t border-ink-100 py-3 text-sm font-medium leading-snug text-ink-700 hover:text-primary-600">
                                    <span class="h-1.5 w-1.5 shrink-0 bg-accent-500"></span>{{ $relatedService->name }}
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
