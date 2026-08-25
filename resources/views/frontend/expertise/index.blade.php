@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="What We Do"
        title="Engineering"
        title-accent="Expertise"
        subtitle="Multi-disciplinary capabilities delivered as integrated solutions, from concept to completion."
        :breadcrumbs="[['name' => 'Expertise']]"
    />

    <section class="bg-surface py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $index => $service)
                    <a href="{{ route('expertise.show', $service->slug) }}"
                        class="wf-card group reveal flex flex-col p-7"
                        style="transition-delay: {{ $index * 60 }}ms">
                        <div class="mb-5 flex items-start justify-between">
                            <span class="icon-tile flex h-12 w-12 items-center justify-center">
                                <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-6 w-6" />
                            </span>
                            @if ($service->is_featured)
                                <span class="rounded-full bg-accent-50 px-2.5 py-1 text-xs font-semibold text-accent-700">Featured</span>
                            @endif
                        </div>

                        <h2 class="mb-2 flex-1 font-heading text-lg leading-snug text-ink-900">{{ $service->name }}</h2>
                        <p class="mb-5 text-sm leading-relaxed text-ink-400">{{ $service->short_description }}</p>

                        <div class="flex items-center justify-between border-t border-ink-100 pt-4">
                            <span class="text-xs font-semibold uppercase tracking-wide text-secondary-500">Explore</span>
                            <span class="arrow-wrap text-accent-600"><x-icon name="arrow-long-right" class="h-5 w-5" /></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative overflow-hidden bg-primary-950 wf-texture py-16">
        <div class="absolute inset-0 bg-gradient-to-br from-primary-950 via-primary-900/90 to-accent-950/40"></div>
        <div class="reveal relative z-10 mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <h2 class="mb-4 font-heading text-3xl text-white md:text-4xl">Need an Integrated Solution?</h2>
            <p class="mb-8 text-primary-200">
                Our multi-disciplinary teams combine expertise across engineering disciplines to deliver seamless,
                end-to-end project delivery.
            </p>
            <a href="{{ route('contact') }}" class="wf-btn-primary group px-8 py-4">
                Discuss Your Project
                <x-icon name="arrow-long-right" class="h-5 w-5 arrow-nudge" />
            </a>
        </div>
    </section>
@endsection
