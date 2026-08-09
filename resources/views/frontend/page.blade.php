@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-20"><div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8"><p class="section-kicker">01 — Information</p><h1 class="mt-7 text-5xl font-semibold text-ink-800 md:text-6xl">{{ $page->title }}</h1>@if ($page->subtitle)<p class="mt-6 text-lg leading-8 text-ink-500">{{ $page->subtitle }}</p>@endif</div></section>
    <section class="bg-white py-20"><article class="prose prose-lg mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">@if ($page->content){!! $page->content !!}@endif @if ($page->sections && array_is_list($page->sections))@foreach ($page->sections as $section)<section class="mt-12 border-t border-ink-200 pt-8">@if (! empty($section['title']))<h2>{{ $section['title'] }}</h2>@endif @if (! empty($section['content'])){!! $section['content'] !!}@endif</section>@endforeach @endif</article></section>
@endsection
