@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Topic"
        :title="'#'.$tag->name"
        size="compact"
        :breadcrumbs="[['name' => 'Insights', 'url' => route('insights.index')], ['name' => '#'.$tag->name]]"
    />

    <section class="bg-surface py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($blogs->count())
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($blogs as $index => $blog)
                        @include('frontend.insights._card', ['blog' => $blog, 'delay' => ($index % 3) * 60])
                    @endforeach
                </div>
                <div class="mt-10">{{ $blogs->links() }}</div>
            @else
                <div class="rounded-2xl border border-ink-100 bg-white py-16 text-center text-ink-400">
                    No posts with this tag yet.
                </div>
            @endif
        </div>
    </section>
@endsection
