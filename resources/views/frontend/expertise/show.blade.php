@extends('layouts.app')

@push('styles')
<style>
    /* Bootstrap-compatible grid inside CMS-authored service descriptions */
    .service-desc .row { display: flex; flex-wrap: wrap; margin: 0 -.75rem; }
    .service-desc [class*="col-"] { width: 100%; padding: 0 .75rem; box-sizing: border-box; }
    @media (min-width: 768px) { .service-desc .col-md-6 { width: 50%; } }
    @media (min-width: 992px) { .service-desc .col-lg-4 { width: 33.333%; } }

    .service-desc .list-unstyled { margin: 0; padding-left: 0; list-style: none; }
    .service-desc .text-center { text-align: center; }
    .service-desc .mt-4 { margin-top: 1.5rem; }
    .service-desc .mt-5 { margin-top: 2rem; }
    .service-desc .mb-3 { margin-bottom: .75rem; }
    .service-desc .mb-4 { margin-bottom: 1rem; }
    .service-desc .mb-5 { margin-bottom: 2rem; }
    .service-desc .me-2 { margin-right: .5rem; }

    .service-desc .service-section h2 {
        font-family: 'Sora', ui-sans-serif, system-ui;
        font-size: 1.35rem; font-weight: 700; color: #0B2437;
        margin-bottom: 1rem; padding-bottom: .5rem; border-bottom: 2px solid #E5F0F6;
    }

    .service-desc .expertise-card {
        background: #F5FBFE; border: 1px solid #E5F0F6; border-radius: 1rem;
        padding: 1.5rem 1rem; margin-bottom: 1rem; color: #0B2437;
    }
    .service-desc .expertise-card h5 {
        font-family: 'Sora', ui-sans-serif, system-ui;
        font-size: .875rem; font-weight: 600; margin: 0; color: #0B2437;
    }
    .service-desc .expertise-card i { color: #00A6A6; }

    .service-desc .text-primary { color: #00A6A6; }
    .service-desc .text-success { color: #16a34a; }
    .service-desc i.fa-3x { display: block; margin-bottom: .75rem; font-size: 2rem; }

    .service-desc .blockquote {
        background: #ECFEFE; border-left: 4px solid #00A6A6; border-radius: .75rem;
        margin: 0; padding: 1.25rem 1.5rem; font-size: 1rem; font-style: italic; color: #12324A;
    }
</style>
@endpush

@section('content')
    <x-page-hero
        :title="$service->name"
        :subtitle="$service->short_description"
        :icon="$service->icon ?? 'building-office-2'"
        size="compact"
        :breadcrumbs="[['name' => 'Expertise', 'url' => route('expertise.index')], ['name' => $service->name]]"
    />

    <section class="bg-white py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-3">
                <article class="reveal-left lg:col-span-2">
                    @if ($service->featured_image)
                        <div class="media-frame mb-8 aspect-video overflow-hidden rounded-2xl">
                            <img src="{{ asset($service->featured_image) }}" alt="{{ $service->name }}" class="h-full w-full object-cover">
                        </div>
                    @endif
                    <div class="prose prose-lg service-desc max-w-none">{!! $service->description !!}</div>
                </article>

                <aside class="reveal-right space-y-6">
                    <div class="wf-panel p-6">
                        <h2 class="mb-3 font-heading text-lg text-white">Start a Project</h2>
                        <p class="mb-5 text-sm text-primary-200">
                            Tell us about your project and we will outline how {{ $settings->get('site_name', 'WaterFirst') }} can deliver it.
                        </p>
                        <a href="{{ route('contact') }}" class="wf-btn-primary w-full py-3 text-sm">Get in Touch</a>
                    </div>

                    @if ($related->count())
                        <div class="wf-panel p-6">
                            <h2 class="mb-4 text-sm font-semibold uppercase tracking-wide text-white">Related Expertise</h2>
                            <div class="space-y-3">
                                @foreach ($related as $relatedService)
                                    <a href="{{ route('expertise.show', $relatedService->slug) }}"
                                        class="group/item flex items-center gap-3 rounded-xl border border-transparent p-3 transition-all hover:border-white/20 hover:bg-white/10">
                                        <span class="wf-chip flex h-9 w-9 items-center justify-center transition-all group-hover/item:bg-accent-500 group-hover/item:text-white">
                                            <x-icon name="{{ $relatedService->icon ?? 'building-office-2' }}" class="h-4 w-4" />
                                        </span>
                                        <span class="text-sm font-medium leading-tight text-primary-100">{{ $relatedService->name }}</span>
                                        <x-icon name="chevron-right" class="ml-auto h-4 w-4 shrink-0 text-primary-300" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="wf-panel p-6">
                        <h2 class="mb-2 text-sm font-semibold text-white">Delivered Across Sectors</h2>
                        <p class="mb-4 text-xs text-primary-200">Municipal · Industrial · Energy · Urban development</p>
                        <a href="{{ route('case-studies.index') }}" class="flex items-center gap-2 text-xs font-semibold text-accent-300 transition-colors hover:text-accent-200">
                            View all case studies <x-icon name="arrow-long-right" class="h-4 w-4" />
                        </a>
                    </div>

                    @php
                        $youtubeId = null;
                        if ($service->youtube_url) {
                            preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/))([\w-]{11})~', $service->youtube_url, $matches);
                            $youtubeId = $matches[1] ?? null;
                        }
                    @endphp
                    @if ($youtubeId)
                        <div class="wf-panel overflow-hidden p-2">
                            <div class="relative w-full overflow-hidden rounded-xl" style="aspect-ratio: 16 / 9">
                                <iframe class="absolute inset-0 h-full w-full"
                                    src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                    title="{{ $service->name }} video" loading="lazy" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </div>
    </section>
@endsection
