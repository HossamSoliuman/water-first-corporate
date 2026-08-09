@extends('layouts.app')

@section('content')
    @php($sec = $page->sections ?? [])
    <section class="interior-hero flow-lines py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'About', 'url' => route('company-overview')], ['name' => $page->title]]" />
            <div class="mt-12 grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3"><p class="section-kicker">01 — Engagement</p></div>
                <div class="lg:col-span-8"><h1 class="text-5xl font-semibold leading-[1.05] text-ink-800 md:text-7xl">{{ $page->title }}</h1>@if ($page->subtitle)<p class="mt-7 max-w-3xl text-lg leading-8 text-ink-500">{{ $page->subtitle }}</p>@endif</div>
            </div>
        </div>
    </section>
    @include('frontend.partials.about-two-column', ['sec' => $sec])
    @include('frontend.partials.about-cards', ['cards' => $cards, 'cardsLabel' => 'Flexible delivery', 'cardsHeading' => 'Engagement models'])
    <section class="deep-band py-20"><div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 sm:px-6 md:flex-row md:items-end md:justify-between lg:px-8"><h2 class="max-w-4xl text-4xl font-semibold text-white md:text-5xl">A delivery model sized to the problem and accountable to the outcome.</h2><a href="{{ route('contact') }}" class="wf-btn-light">Discuss your project</a></div></section>
@endsection
