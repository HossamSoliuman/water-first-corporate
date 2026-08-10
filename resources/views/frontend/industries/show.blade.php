@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-10 md:py-14"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><x-breadcrumbs :items="[['name' => 'Industries'], ['name' => $industry->name]]" /><div class="mt-6 grid gap-x-8 gap-y-5 lg:grid-cols-12"><div class="lg:col-span-12"><h1 class="text-[clamp(1.75rem,3.6vw,3rem)] font-semibold leading-[1.05] text-ink-800">{{ $industry->name }}</h1>@if ($industry->description)<p class="mt-5 max-w-3xl text-lg leading-8 text-ink-500">{{ $industry->description }}</p>@endif</div></div></div></section>
    <section class="bg-surface py-14 md:py-16"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">@if ($caseStudies->count())<div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">@foreach ($caseStudies as $index => $caseStudy)@include('frontend.case-studies._card', ['cs' => $caseStudy, 'index' => $index + 1])@endforeach</div><div class="mt-10">{{ $caseStudies->links() }}</div>@else<div class="technical-rule bg-white p-8 text-ink-500">Project records for this sector are being prepared.</div>@endif</div></section>
@endsection
