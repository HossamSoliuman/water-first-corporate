@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-10 md:py-14"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><x-breadcrumbs :items="[['name' => 'Industries']]" /><div class="mt-6 grid gap-x-8 gap-y-5 lg:grid-cols-12"><div class="lg:col-span-12"><h1 class="text-[clamp(1.75rem,3.6vw,3rem)] font-semibold text-ink-800">Industries we serve</h1><p class="mt-5 text-lg leading-8 text-ink-500">Water-critical sectors where technical precision and compliance shape project performance.</p></div></div></div></section>
    <section class="bg-surface py-14 md:py-16"><div class="mx-auto grid max-w-7xl gap-5 px-4 sm:px-6 md:grid-cols-2 lg:grid-cols-4 lg:px-8">@foreach ($industries as $index => $industry)<a href="{{ route('industries.show', $industry->slug) }}" class="wf-card group p-6"><span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span><h2 class="mt-7 text-lg font-semibold text-ink-800 group-hover:text-primary-600">{{ $industry->name }}</h2><p class="mt-3 text-sm leading-6 text-ink-500">{{ $industry->description }}</p></a>@endforeach</div></section>
@endsection
