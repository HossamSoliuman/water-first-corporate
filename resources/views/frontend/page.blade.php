@extends('layouts.app')

@section('content')
    <x-page-hero
        :title="$page->title"
        :subtitle="$page->subtitle"
        size="compact"
        :breadcrumbs="[['name' => $page->title]]"
    />

    <section class="bg-white py-16">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            @if ($page->content)
                <div class="prose prose-lg max-w-none">{!! $page->content !!}</div>
            @endif

            @if ($page->sections && array_is_list($page->sections))
                @foreach ($page->sections as $section)
                    <div class="mt-12 border-t border-ink-100 pt-8">
                        @if (! empty($section['title']))
                            <h2 class="mb-4 font-heading text-2xl font-bold text-ink-900">{{ $section['title'] }}</h2>
                        @endif
                        @if (! empty($section['content']))
                            <div class="prose max-w-none">{!! $section['content'] !!}</div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection
