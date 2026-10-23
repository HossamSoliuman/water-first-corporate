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
        font-family: 'Archivo', ui-sans-serif, system-ui; font-stretch: 108%;
        font-size: 1.5rem; font-weight: 650; color: #0B2437;
        margin-bottom: 1rem; padding-bottom: .6rem; border-bottom: 1px solid #DCEAF3;
    }

    .service-desc .expertise-card {
        background: #FFFFFF; border: 1px solid #DCEAF3; border-radius: 6px;
        padding: 1.5rem 1rem; margin-bottom: 1rem; color: #0B2437;
    }
    .service-desc .expertise-card h5 {
        font-family: 'Archivo', ui-sans-serif, system-ui;
        font-size: .9rem; font-weight: 600; margin: 0; color: #0B2437;
    }
    .service-desc .expertise-card i { color: #00A6A6; }

    .service-desc .text-primary { color: #00A6A6; }
    .service-desc .text-success { color: #16a34a; }
    .service-desc i.fa-3x { display: block; margin-bottom: .75rem; font-size: 2rem; }

    .service-desc .blockquote {
        background: #F5FBFE; border-left: 2px solid #00A6A6; border-radius: 0;
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

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12">
                <article class="reveal lg:col-span-8">
                    @if ($service->featured_image)
                        <div class="media-frame mb-10 aspect-video rounded">
                            <img src="{{ asset($service->featured_image) }}" alt="{{ $service->name }}" class="h-full w-full object-cover">
                        </div>
                    @endif
                    <div class="prose prose-lg service-desc max-w-none">{!! $service->description !!}</div>
                </article>

                <aside class="lg:col-span-4">
                    <div class="space-y-10 lg:sticky lg:top-32">
                        <div class="border-t-2 border-primary-600 pt-6">
                            <h2 class="text-xl font-semibold text-ink-900">Start a project</h2>
                            <p class="mt-3 text-sm leading-6 text-ink-600">
                                Tell us about your project and we will outline how {{ $settings->get('site_name', 'WaterFirst') }} can deliver it.
                            </p>
                            <a href="{{ route('contact') }}" class="wf-btn-primary group mt-6 w-full">
                                Get in touch <x-icon name="arrow-long-right" class="arrow-nudge h-4 w-4" />
                            </a>
                        </div>

                        @if ($related->count())
                            <div>
                                <h2 class="font-mono text-[11px] font-medium uppercase tracking-[.14em] text-ink-500">Related expertise</h2>
                                <ul class="mt-4 border-t border-line">
                                    @foreach ($related as $relatedService)
                                        <li>
                                            <a href="{{ route('expertise.show', $relatedService->slug) }}" class="group flex items-center gap-3 border-b border-line py-3.5">
                                                <x-icon name="{{ $relatedService->icon ?? 'building-office-2' }}" class="h-5 w-5 shrink-0 text-primary-600" />
                                                <span class="flex-1 text-sm font-medium text-ink-800 group-hover:text-primary-600">{{ $relatedService->name }}</span>
                                                <x-icon name="arrow-long-right" class="h-4 w-4 shrink-0 text-ink-300 group-hover:text-primary-600" />
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <a href="{{ route('case-studies.index') }}" class="group flex items-center justify-between rounded bg-surface px-5 py-4 text-sm font-semibold text-ink-900">
                            View all case studies
                            <x-icon name="arrow-long-right" class="arrow-nudge h-4 w-4 text-primary-600" />
                        </a>

                        @php
                            $youtubeId = null;
                            if ($service->youtube_url) {
                                preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/))([\w-]{11})~', $service->youtube_url, $matches);
                                $youtubeId = $matches[1] ?? null;
                            }
                        @endphp
                        @if ($youtubeId)
                            <div class="relative w-full overflow-hidden rounded bg-ink-900" style="aspect-ratio: 16 / 9">
                                <iframe class="absolute inset-0 h-full w-full"
                                    src="https://www.youtube-nocookie.com/embed/{{ $youtubeId }}"
                                    title="{{ $service->name }} video" loading="lazy" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
