@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Sector"
        :title="$industry->name"
        :subtitle="$industry->description"
        size="compact"
        :breadcrumbs="[['name' => 'Industries'], ['name' => $industry->name]]"
    />

    <section class="bg-surface py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($caseStudies->count())
                <div class="mb-10">
                    <p class="eyebrow mb-3">Our Work</p>
                    <h2 class="font-heading text-3xl text-ink-900">Case studies in {{ $industry->name }}</h2>
                </div>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    @foreach ($caseStudies as $index => $caseStudy)
                        @include('frontend.case-studies._card', ['cs' => $caseStudy, 'delay' => ($index % 3) * 80])
                    @endforeach
                </div>
                <div class="mt-10">{{ $caseStudies->links() }}</div>
            @else
                <div class="rounded-2xl border border-ink-100 bg-white py-16 text-center text-ink-400">
                    No case studies yet for this industry.
                </div>
            @endif
        </div>
    </section>
@endsection
