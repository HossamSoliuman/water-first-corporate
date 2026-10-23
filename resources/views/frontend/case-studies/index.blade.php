@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Our work"
        title="Case"
        title-accent="studies"
        :breadcrumbs="[['name' => 'Case Studies']]"
    />

    <section class="bg-white py-14 md:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('case-studies.index') }}" class="space-y-5 border-b border-line pb-8">
                @foreach (array_filter([
                    $categories->count() ? ['category', 'Category', $categories] : null,
                    $industries->count() ? ['industry', 'Industry', $industries] : null,
                ]) as [$field, $label, $options])
                    <div class="grid gap-3 md:grid-cols-[110px_1fr] md:items-start">
                        <span id="filter-{{ $field }}" class="pt-2 font-mono text-[11px] uppercase tracking-[.14em] text-ink-500">{{ $label }}</span>
                        <div class="flex flex-wrap gap-2" role="radiogroup" aria-labelledby="filter-{{ $field }}">
                            @foreach ($options as $option)
                                <label class="cursor-pointer">
                                    <input type="radio" name="{{ $field }}" value="{{ $option->slug }}" @checked(request($field) === $option->slug)
                                        class="peer sr-only" onchange="this.form.submit()">
                                    <span class="inline-flex items-center gap-2 rounded border border-ink-200 px-3 py-1.5 text-sm text-ink-700 transition-colors hover:border-primary-600 peer-checked:border-primary-600 peer-checked:bg-primary-600 peer-checked:text-white peer-focus-visible:ring-2 peer-focus-visible:ring-accent-500">
                                        {{ $option->name }}
                                        <span class="font-mono text-[11px] opacity-70">{{ $option->case_studies_count }}</span>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                @if (request()->hasAny(['category', 'industry']))
                    <a href="{{ route('case-studies.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary-600 hover:underline">
                        <x-icon name="x-mark" class="h-4 w-4" /> Clear filters
                    </a>
                @endif
            </form>

            @if ($caseStudies->count())
                <div class="mt-12 grid grid-cols-1 gap-x-8 gap-y-12 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($caseStudies as $index => $caseStudy)
                        @include('frontend.case-studies._card', ['cs' => $caseStudy, 'delay' => ($index % 3) * 80])
                    @endforeach
                </div>
                <div class="mt-12">{{ $caseStudies->links() }}</div>
            @else
                <div class="mt-12 rounded bg-surface px-6 py-16 text-center">
                    <p class="text-lg text-ink-600">No case studies match these filters.</p>
                    <a href="{{ route('case-studies.index') }}" class="mt-4 inline-block text-sm font-semibold text-primary-600 hover:underline">Show all case studies</a>
                </div>
            @endif
        </div>
    </section>
@endsection
