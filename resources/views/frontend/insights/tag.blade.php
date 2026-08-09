@extends('layouts.app')
@section('content')
    <section class="interior-hero flow-lines py-20"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><x-breadcrumbs :items="[['name' => 'Insights', 'url' => route('insights.index')], ['name' => '#'.$tag->name]]" /><p class="section-kicker mt-10">01 — Topic</p><h1 class="mt-6 text-5xl font-semibold text-ink-800">#{{ $tag->name }}</h1></div></section>
    <section class="bg-surface py-20"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">@if ($blogs->count())<div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">@foreach ($blogs as $blog)@include('frontend.insights._card', ['blog' => $blog])@endforeach</div><div class="mt-10">{{ $blogs->links() }}</div>@else<div class="technical-rule bg-white p-8 text-ink-500">No published insights use this topic yet.</div>@endif</div></section>
@endsection
