@extends('layouts.app')

@section('content')
    <x-page-hero
        :title="$caseStudy->title"
        size="compact"
        :breadcrumbs="[['name' => 'Case Studies', 'url' => route('case-studies.index')], ['name' => $caseStudy->title]]"
    >
        @if ($caseStudy->industry || $caseStudy->category || $caseStudy->client_name)
            <div class="mt-6 flex flex-wrap items-center gap-3">
                @if ($caseStudy->industry)
                    <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white">{{ $caseStudy->industry->name }}</span>
                @endif
                @if ($caseStudy->category)
                    <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white">{{ $caseStudy->category->name }}</span>
                @endif
                @if ($caseStudy->client_name)
                    <span class="text-sm text-primary-200">Client: {{ $caseStudy->client_name }}</span>
                @endif
            </div>
        @endif
    </x-page-hero>

    <section class="bg-white py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
                <article class="space-y-10 lg:col-span-2">
                    @if ($caseStudy->featured_image)
                        <div class="media-frame overflow-hidden rounded-2xl">
                            <img src="{{ asset($caseStudy->featured_image) }}" alt="{{ $caseStudy->title }}" class="w-full">
                        </div>
                    @endif

                    @foreach ([['The Challenge', $caseStudy->challenge], ['Our Solution', $caseStudy->solution], ['The Results', $caseStudy->result]] as [$heading, $content])
                        @if ($content)
                            <div>
                                <h2 class="mb-4 font-heading text-2xl font-bold text-ink-900">{{ $heading }}</h2>
                                <div class="prose max-w-none">{!! $content !!}</div>
                            </div>
                        @endif
                    @endforeach

                    @if ($caseStudy->gallery && count($caseStudy->gallery))
                        @php($galleryUrls = collect($caseStudy->gallery)->map(fn ($image) => asset($image))->values())
                        <div x-data="{
                                open: false,
                                active: 0,
                                images: @js($galleryUrls),
                                show(index) { this.active = index; this.open = true; document.body.style.overflow = 'hidden'; },
                                close() { this.open = false; document.body.style.overflow = ''; },
                                next() { this.active = (this.active + 1) % this.images.length; },
                                prev() { this.active = (this.active - 1 + this.images.length) % this.images.length; }
                             }"
                            @keydown.escape.window="close()"
                            @keydown.arrow-right.window="open && next()"
                            @keydown.arrow-left.window="open && prev()">
                            <h2 class="mb-6 font-heading text-2xl font-bold text-ink-900">Gallery</h2>

                            <div class="-mx-4 flex snap-x snap-mandatory gap-4 overflow-x-auto scroll-smooth px-4 pb-4">
                                @foreach ($caseStudy->gallery as $index => $image)
                                    <button type="button" @click="show({{ $index }})"
                                        class="group relative shrink-0 snap-start overflow-hidden rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-500 focus:ring-offset-2">
                                        <img src="{{ asset($image) }}" alt="{{ $caseStudy->title }} — image {{ $index + 1 }}" loading="lazy"
                                            class="h-44 w-64 object-cover transition-transform duration-500 group-hover:scale-105 sm:h-52 sm:w-80">
                                        <span class="pointer-events-none absolute inset-0 flex items-center justify-center bg-primary-950/0 transition-colors duration-300 group-hover:bg-primary-950/30">
                                            <span class="translate-y-1 rounded-full bg-white/90 p-2.5 text-primary-950 opacity-0 shadow transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6"/>
                                                </svg>
                                            </span>
                                        </span>
                                    </button>
                                @endforeach
                            </div>

                            <div x-show="open" x-cloak
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                @click.self="close()"
                                class="fixed inset-0 z-[100] flex items-center justify-center bg-primary-950/95 p-4 backdrop-blur-sm sm:p-8">

                                <button type="button" @click="close()" aria-label="Close gallery"
                                    class="absolute right-4 top-4 rounded-full bg-white/10 p-2.5 text-white transition-colors hover:bg-white/20 sm:right-6 sm:top-6">
                                    <x-icon name="x-mark" class="h-6 w-6" />
                                </button>

                                <button type="button" @click.stop="prev()" x-show="images.length > 1" aria-label="Previous image"
                                    class="absolute left-3 rounded-full bg-white/10 p-2.5 text-white transition-colors hover:bg-white/20 sm:left-6">
                                    <x-icon name="chevron-left" class="h-6 w-6" />
                                </button>

                                <img :src="images[active]" :alt="'Gallery image ' + (active + 1)" @click.stop
                                    class="max-h-[85vh] max-w-full rounded-xl object-contain shadow-2xl">

                                <button type="button" @click.stop="next()" x-show="images.length > 1" aria-label="Next image"
                                    class="absolute right-3 rounded-full bg-white/10 p-2.5 text-white transition-colors hover:bg-white/20 sm:right-6">
                                    <x-icon name="chevron-right" class="h-6 w-6" />
                                </button>

                                <div x-show="images.length > 1" class="absolute bottom-5 left-1/2 -translate-x-1/2 rounded-full bg-white/10 px-4 py-1.5 text-sm font-medium text-white">
                                    <span x-text="active + 1"></span> / <span x-text="images.length"></span>
                                </div>
                            </div>
                        </div>
                    @endif
                </article>

                <aside class="space-y-6">
                    @if ($caseStudy->pdf_file)
                        <a href="{{ route('case-studies.download', $caseStudy->slug) }}" class="wf-btn-deep w-full px-5 py-4">
                            <x-icon name="document-arrow-down" class="h-5 w-5" />
                            Download PDF
                        </a>
                    @endif

                    <div class="wf-panel p-6">
                        <h2 class="mb-3 font-heading font-bold text-white">{{ $caseStudy->cta_title ?: 'Plan Your Project' }}</h2>
                        <p class="mb-4 text-sm text-primary-200">
                            {{ $caseStudy->cta_text ?: 'Bring '.$settings->get('site_name', 'WaterFirst').' in from feasibility, detailed engineering or delivery support.' }}
                        </p>
                        <a href="{{ $caseStudy->cta_link ?: route('contact') }}" class="wf-btn-primary w-full py-3 text-sm">Get Started</a>
                    </div>

                    @if ($related->count())
                        <div class="rounded-2xl border border-ink-100 bg-white p-6">
                            <h2 class="mb-4 font-semibold text-ink-900">Related Work</h2>
                            <div class="space-y-4">
                                @foreach ($related as $relatedCaseStudy)
                                    <a href="{{ route('case-studies.show', $relatedCaseStudy->slug) }}" class="group flex gap-3">
                                        @if ($relatedCaseStudy->featured_image)
                                            <img src="{{ asset($relatedCaseStudy->featured_image) }}" alt="{{ $relatedCaseStudy->title }}" class="h-16 w-16 shrink-0 rounded-lg object-cover">
                                        @endif
                                        <div>
                                            <p class="text-sm font-medium leading-snug text-ink-900 transition-colors group-hover:text-accent-600">{{ $relatedCaseStudy->title }}</p>
                                            @if ($relatedCaseStudy->client_name)
                                                <p class="mt-0.5 text-xs text-ink-400">{{ $relatedCaseStudy->client_name }}</p>
                                            @endif
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
