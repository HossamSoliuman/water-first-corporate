@extends('layouts.app')
@section('content')
    <section class="interior-hero flow-lines py-20"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><x-breadcrumbs :items="[['name' => 'Insights', 'url' => route('insights.index')], ['name' => $category->name]]" /><p class="section-kicker mt-10">01 — Category</p><h1 class="mt-6 text-5xl font-semibold text-ink-800">{{ $category->name }}</h1>@if ($category->description)<p class="mt-5 text-lg text-ink-500">{{ $category->description }}</p>@endif</div></section>
    <section class="bg-surface py-20"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">@if ($blogs->count())<div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">@foreach ($blogs as $blog)@include('frontend.insights._card', ['blog' => $blog])@endforeach</div><div class="mt-10">{{ $blogs->links() }}</div>@else<div class="technical-rule bg-white p-8 text-ink-500">No published insights in this category yet.</div>@endif</div></section>
@endsection
