@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'Expertise']]" />
            <div class="mt-12 grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3"><p class="section-kicker">01 — Expertise</p></div>
                <div class="lg:col-span-8">
                    <h1 class="text-5xl font-semibold leading-[1.05] text-ink-800 md:text-7xl">Everything we engineer starts with water.</h1>
                    <p class="mt-7 max-w-3xl text-lg leading-8 text-ink-500">Twelve connected areas of expertise spanning water supply and treatment, sewerage and wastewater, reuse and desalination, residuals, environmental assessment, detailed engineering and long-term operations.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-surface py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $index => $service)
                    <a href="{{ route('expertise.show', $service->slug) }}" class="wf-card group flex min-h-72 flex-col p-7 reveal">
                        <div class="flex items-start justify-between">
                            <span class="flex h-11 w-11 items-center justify-center border border-accent-500 text-accent-600"><x-icon name="{{ $service->icon ?? 'building-office-2' }}" class="h-5 w-5" /></span>
                            <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h2 class="mt-8 text-xl font-semibold leading-snug text-ink-800 group-hover:text-primary-600">{{ $service->name }}</h2>
                        <p class="mt-3 flex-1 text-sm leading-6 text-ink-500">{{ $service->short_description }}</p>
                        <div class="mt-6 flex items-center justify-between border-t border-ink-100 pt-4 text-xs font-semibold uppercase tracking-wider text-primary-600">
                            Explore <x-icon name="arrow-long-right" class="h-4 w-4" />
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
