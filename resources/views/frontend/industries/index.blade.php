@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-20 md:py-28"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><x-breadcrumbs :items="[['name' => 'Industries']]" /><div class="mt-12 grid gap-10 lg:grid-cols-12"><div class="lg:col-span-3"><p class="section-kicker">01 — Sectors</p></div><div class="lg:col-span-8"><h1 class="text-5xl font-semibold text-ink-800 md:text-7xl">Industries we serve</h1><p class="mt-7 text-lg leading-8 text-ink-500">Water-critical sectors where technical precision and compliance shape project performance.</p></div></div></div></section>
    <section class="bg-surface py-20"><div class="mx-auto grid max-w-7xl gap-5 px-4 sm:px-6 md:grid-cols-2 lg:grid-cols-4 lg:px-8">@foreach ($industries as $index => $industry)<a href="{{ route('industries.show', $industry->slug) }}" class="wf-card group p-6"><span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span><h2 class="mt-7 text-lg font-semibold text-ink-800 group-hover:text-primary-600">{{ $industry->name }}</h2><p class="mt-3 text-sm leading-6 text-ink-500">{{ $industry->description }}</p></a>@endforeach</div></section>
@endsection
