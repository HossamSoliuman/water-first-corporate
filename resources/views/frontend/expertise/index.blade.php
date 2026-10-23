@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="What we do"
        title="Engineering"
        title-accent="expertise"
        :breadcrumbs="[['name' => 'Expertise']]"
    />

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid border-l border-t border-line md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $index => $service)
                    <a href="{{ route('expertise.show', $service->slug) }}"
                        class="group reveal flex flex-col border-b border-r border-line p-6 transition-colors hover:bg-surface md:p-7"
                        style="transition-delay: {{ ($index % 3) * 60 }}ms">
                        <div class="media-frame aspect-[16/9] rounded">
                            @if ($service->featured_image)
                                <img src="{{ asset($service->featured_image) }}" alt="" loading="lazy" decoding="async" class="h-full w-full object-cover">
                            @else
                                <div class="flow-lines h-full w-full bg-surface"></div>
                            @endif
                        </div>

                        <div class="mt-6 flex items-center gap-3 text-primary-600">
                            <x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-5 w-5" />
                            @if ($service->is_featured)
                                <span class="font-mono text-[11px] uppercase tracking-[.12em] text-accent-700">Featured</span>
                            @endif
                        </div>

                        <h2 class="mt-3 text-xl font-semibold leading-snug text-ink-900">
                            <span class="underline-grow">{{ $service->name }}</span>
                        </h2>
                        <p class="mt-3 flex-1 text-sm leading-6 text-ink-600">{{ $service->short_description }}</p>

                        <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-primary-600">
                            Explore <x-icon name="arrow-long-right" class="arrow-nudge h-4 w-4" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="border-t border-line bg-surface py-14 md:py-16">
        <div class="mx-auto flex max-w-7xl flex-col justify-between gap-8 px-4 sm:px-6 md:flex-row md:items-center lg:px-8">
            <div class="reveal-left max-w-2xl">
                <h2 class="text-3xl leading-tight text-ink-900 md:text-4xl">Need an integrated solution?</h2>
                <p class="mt-4 text-base leading-7 text-ink-600">
                    Our multi-disciplinary teams combine expertise across engineering disciplines to deliver seamless,
                    end-to-end project delivery.
                </p>
            </div>
            <a href="{{ route('contact') }}" class="reveal-right wf-btn-primary group shrink-0 px-6 py-3.5">
                Discuss your project <x-icon name="arrow-long-right" class="arrow-nudge h-5 w-5" />
            </a>
        </div>
    </section>
@endsection
