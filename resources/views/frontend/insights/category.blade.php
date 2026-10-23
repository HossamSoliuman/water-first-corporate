@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Insights"
        :title="$category->name"
        :subtitle="$category->description"
        size="compact"
        :breadcrumbs="[['name' => 'Insights', 'url' => route('insights.index')], ['name' => $category->name]]"
    />

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($blogs->count())
                <div class="grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($blogs as $index => $blog)
                        @include('frontend.insights._card', ['blog' => $blog, 'delay' => ($index % 3) * 60])
                    @endforeach
                </div>
                <div class="mt-12">{{ $blogs->links() }}</div>
            @else
                <div class="rounded bg-surface px-6 py-16 text-center">
                    <p class="text-lg text-ink-600">No articles in this category yet.</p>
                    <a href="{{ route('insights.index') }}" class="mt-4 inline-block text-sm font-semibold text-primary-600 hover:underline">Show all articles</a>
                </div>
            @endif
        </div>
    </section>
@endsection
