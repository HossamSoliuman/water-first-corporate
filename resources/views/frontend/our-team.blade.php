@extends('layouts.app')

@section('content')
    @php($sec = $page->sections ?? [])
    <section class="interior-hero flow-lines py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'About', 'url' => route('company-overview')], ['name' => $page->title]]" />
            <div class="mt-12 grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3"><p class="section-kicker">01 — People</p></div>
                <div class="lg:col-span-8">
                    <h1 class="text-5xl font-semibold leading-[1.05] text-ink-800 md:text-7xl">{{ $page->title }}</h1>
                    @if ($page->subtitle)<p class="mt-7 max-w-3xl text-lg leading-8 text-ink-500">{{ $page->subtitle }}</p>@endif
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.about-two-column', ['sec' => $sec])

    @if ($teamMembers->count())
        <section class="border-y border-ink-200 bg-surface py-20">
            <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
                <aside class="lg:col-span-3"><div class="sticky-label"><p class="section-kicker">03 — Leadership</p><h2 class="mt-6 text-3xl font-semibold text-ink-800">Experience in the field.</h2></div></aside>
                <div class="grid gap-5 md:grid-cols-2 lg:col-span-9">
                    @foreach ($teamMembers as $index => $member)
                        <article class="wf-card overflow-hidden reveal">
                            @if ($member->photo)
                                <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}" class="aspect-[4/3] w-full object-cover object-top" loading="lazy">
                            @else
                                <div class="flex aspect-[4/3] items-center justify-center bg-primary-50"><x-icon name="user-circle" class="h-20 w-20 text-primary-200" /></div>
                            @endif
                            <div class="p-6">
                                <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3 class="mt-5 text-xl font-semibold text-ink-800">{{ $member->name }}</h3>
                                <p class="mt-2 font-mono text-xs uppercase tracking-wider text-primary-600">{{ $member->role }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="deep-band py-20"><div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 sm:px-6 md:flex-row md:items-end md:justify-between lg:px-8"><h2 class="max-w-4xl text-4xl font-semibold text-white md:text-5xl">Build a career around work that protects water.</h2><a href="{{ route('careers') }}" class="wf-btn-light">View careers</a></div></section>
@endsection
