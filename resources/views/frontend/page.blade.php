@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-10 md:py-14"><div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8"><h1 class="text-[clamp(1.75rem,3.6vw,3rem)] font-semibold text-ink-800">{{ $page->title }}</h1>@if ($page->subtitle)<p class="mt-6 text-lg leading-8 text-ink-500">{{ $page->subtitle }}</p>@endif</div></section>
    <section class="bg-white py-14 md:py-16"><article class="prose prose-lg mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">@if ($page->content){!! $page->content !!}@endif @if ($page->sections && array_is_list($page->sections))@foreach ($page->sections as $section)<section class="mt-12 border-t border-ink-200 pt-8">@if (! empty($section['title']))<h2>{{ $section['title'] }}</h2>@endif @if (! empty($section['content'])){!! $section['content'] !!}@endif</section>@endforeach @endif</article></section>
@endsection
