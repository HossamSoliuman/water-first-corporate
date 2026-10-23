@extends('layouts.app')

@section('content')
    <x-page-hero
        :title="$page->title"
        :subtitle="$page->subtitle"
        size="compact"
        :breadcrumbs="[['name' => $page->title]]"
    />

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                @if ($page->content)
                    <div class="prose prose-lg max-w-none">{!! $page->content !!}</div>
                @endif

                @if ($page->sections && array_is_list($page->sections))
                    @foreach ($page->sections as $section)
                        <div class="mt-12 border-t border-line pt-8">
                            @if (! empty($section['title']))
                                <h2 class="mb-4 text-2xl font-semibold text-ink-900">{{ $section['title'] }}</h2>
                            @endif
                            @if (! empty($section['content']))
                                <div class="prose max-w-none">{!! $section['content'] !!}</div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
