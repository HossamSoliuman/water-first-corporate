@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Sector"
        :title="$industry->name"
        :subtitle="$industry->description"
        size="compact"
        :breadcrumbs="[['name' => 'Industries'], ['name' => $industry->name]]"
    />

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if ($caseStudies->count())
                <div>
                    <p class="eyebrow">Our work</p>
                    <h2 class="mt-6 text-3xl text-ink-900 md:text-4xl">Case studies in {{ $industry->name }}</h2>
                </div>
                <div class="mt-12 grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($caseStudies as $index => $caseStudy)
                        @include('frontend.case-studies._card', ['cs' => $caseStudy, 'delay' => ($index % 3) * 80])
                    @endforeach
                </div>
                <div class="mt-12">{{ $caseStudies->links() }}</div>
            @else
                <div class="rounded bg-surface px-6 py-16 text-center">
                    <p class="text-lg text-ink-600">No case studies are published for this industry yet.</p>
                    <a href="{{ route('case-studies.index') }}" class="mt-4 inline-block text-sm font-semibold text-primary-600 hover:underline">Browse all case studies</a>
                </div>
            @endif
        </div>
    </section>
@endsection
