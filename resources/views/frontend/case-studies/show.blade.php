@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'Case Studies', 'url' => route('case-studies.index')], ['name' => $caseStudy->title]]" />
            <div class="mt-12 grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3"><p class="section-kicker">01 — Project</p></div>
                <div class="lg:col-span-8">
                    <div class="flex flex-wrap gap-3 font-mono text-[10px] uppercase tracking-[.14em] text-primary-600">@if ($caseStudy->industry)<span>{{ $caseStudy->industry->name }}</span>@endif @if ($caseStudy->category)<span class="text-accent-700">/ {{ $caseStudy->category->name }}</span>@endif</div>
                    <h1 class="mt-6 text-4xl font-semibold leading-[1.08] text-ink-800 md:text-6xl"><span class="font-metric">{{ $caseStudy->title }}</span></h1>
                    @if ($caseStudy->client_name)<p class="mt-7 text-sm text-ink-500"><span class="font-semibold text-ink-800">Client / project partners:</span> {{ $caseStudy->client_name }}</p>@endif
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <article class="space-y-12 lg:col-span-8">
                @if ($caseStudy->featured_image)<img src="{{ asset($caseStudy->featured_image) }}" alt="{{ $caseStudy->title }}" class="w-full border border-ink-200">@endif
                @foreach ([['02', 'The challenge', $caseStudy->challenge], ['03', 'Our solution', $caseStudy->solution], ['04', 'The result', $caseStudy->result]] as [$number, $heading, $content])
                    <section class="grid gap-6 border-t border-ink-200 pt-8 md:grid-cols-4">
                        <div><p class="section-index">{{ $number }}</p><h2 class="mt-3 text-xl font-semibold text-ink-800">{{ $heading }}</h2></div>
                        <div class="prose max-w-none md:col-span-3">{!! $content !!}</div>
                    </section>
                @endforeach

                @if ($caseStudy->gallery && count($caseStudy->gallery))
                    @php($galleryUrls = collect($caseStudy->gallery)->map(fn ($image) => asset($image))->values())
                    <section x-data="{ open: false, active: 0, images: @js($galleryUrls), show(index) { this.active = index; this.open = true; document.body.style.overflow = 'hidden'; }, close() { this.open = false; document.body.style.overflow = ''; }, next() { this.active = (this.active + 1) % this.images.length; }, prev() { this.active = (this.active - 1 + this.images.length) % this.images.length; } }" @keydown.escape.window="close()" @keydown.arrow-right.window="open && next()" @keydown.arrow-left.window="open && prev()" class="border-t border-ink-200 pt-8">
                        <p class="section-index">05</p><h2 class="mt-3 text-xl font-semibold text-ink-800">Project gallery</h2>
                        <div class="mt-6 flex gap-4 overflow-x-auto pb-4">@foreach ($caseStudy->gallery as $index => $image)<button type="button" @click="show({{ $index }})" class="shrink-0 border border-ink-200 focus:border-accent-500 focus:outline-none"><img src="{{ asset($image) }}" alt="{{ $caseStudy->title }} image {{ $index + 1 }}" class="h-52 w-80 object-cover" loading="lazy"></button>@endforeach</div>
                        <div x-show="open" x-cloak x-transition @click.self="close()" class="fixed inset-0 z-[100] flex items-center justify-center bg-ink-950/95 p-6">
                            <button type="button" @click="close()" class="absolute right-6 top-6 border border-primary-200 p-2 text-white" aria-label="Close gallery"><x-icon name="x-mark" class="h-5 w-5" /></button>
                            <button type="button" @click.stop="prev()" x-show="images.length > 1" class="absolute left-6 border border-primary-200 p-2 text-white" aria-label="Previous image"><x-icon name="chevron-left" class="h-5 w-5" /></button>
                            <img :src="images[active]" :alt="'Gallery image ' + (active + 1)" class="max-h-[85vh] max-w-full object-contain">
                            <button type="button" @click.stop="next()" x-show="images.length > 1" class="absolute right-6 border border-primary-200 p-2 text-white" aria-label="Next image"><x-icon name="chevron-right" class="h-5 w-5" /></button>
                        </div>
                    </section>
                @endif
            </article>

            <aside class="space-y-5 lg:col-span-4">
                <div class="sticky-label space-y-5">
                    @if ($caseStudy->pdf_file)<a href="{{ route('case-studies.download', $caseStudy->slug) }}" class="wf-btn-outline w-full"><x-icon name="document-arrow-down" class="h-4 w-4" /> Download project PDF</a>@endif
                    <div class="technical-rule bg-surface p-6">
                        <h2 class="text-xl font-semibold text-ink-800">{{ $caseStudy->cta_title ?: 'Plan a water project' }}</h2>
                        <p class="mt-3 text-sm leading-6 text-ink-500">{{ $caseStudy->cta_text ?: 'Bring WaterFirst into the project from feasibility, detailed engineering or delivery support.' }}</p>
                        <a href="{{ $caseStudy->cta_link ?: route('contact') }}" class="wf-btn-primary mt-6 w-full">Start a conversation</a>
                    </div>
                    @if ($related->count())<div class="border border-ink-200 bg-white p-6"><h2 class="font-mono text-[10px] uppercase tracking-[.16em] text-primary-600">Related projects</h2><div class="mt-4 grid">@foreach ($related as $relatedCaseStudy)<a href="{{ route('case-studies.show', $relatedCaseStudy->slug) }}" class="border-t border-ink-100 py-3 text-sm font-medium leading-snug text-ink-700 hover:text-primary-600">{{ $relatedCaseStudy->title }}</a>@endforeach</div></div>@endif
                </div>
            </aside>
        </div>
    </section>
@endsection
