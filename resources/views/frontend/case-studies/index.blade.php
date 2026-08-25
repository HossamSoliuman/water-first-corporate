@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Our Work"
        title="Case"
        title-accent="Studies"
        subtitle="Real-world results from our client engagements, across infrastructure, water and industry."
        :breadcrumbs="[['name' => 'Case Studies']]"
    />

    <section class="bg-surface py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-10 lg:flex-row">

                <aside class="w-full shrink-0 lg:w-64">
                    <form method="GET" action="{{ route('case-studies.index') }}" class="space-y-6 rounded-2xl border border-ink-100 bg-white p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="eyebrow">Filters</h2>
                            @if (request()->hasAny(['category', 'industry']))
                                <a href="{{ route('case-studies.index') }}" class="text-xs font-semibold text-accent-600 hover:underline">Clear</a>
                            @endif
                        </div>

                        @if ($categories->count())
                            <div>
                                <h3 class="mb-3 text-sm font-semibold uppercase tracking-wide text-ink-800">Category</h3>
                                <div class="space-y-2">
                                    @foreach ($categories as $category)
                                        <label class="flex cursor-pointer items-center gap-2">
                                            <input type="radio" name="category" value="{{ $category->slug }}" @checked(request('category') === $category->slug)
                                                class="text-accent-600 focus:ring-accent-500" onchange="this.form.submit()">
                                            <span class="text-sm text-ink-600">{{ $category->name }}</span>
                                            <span class="ml-auto text-xs text-ink-400">{{ $category->case_studies_count }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div>
                            <h3 class="mb-3 text-sm font-semibold uppercase tracking-wide text-ink-800">Industry</h3>
                            <div class="space-y-2">
                                @foreach ($industries as $industry)
                                    <label class="flex cursor-pointer items-center gap-2">
                                        <input type="radio" name="industry" value="{{ $industry->slug }}" @checked(request('industry') === $industry->slug)
                                            class="text-accent-600 focus:ring-accent-500" onchange="this.form.submit()">
                                        <span class="text-sm text-ink-600">{{ $industry->name }}</span>
                                        <span class="ml-auto text-xs text-ink-400">{{ $industry->case_studies_count }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </aside>

                <div class="flex-1">
                    @if ($caseStudies->count())
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
                            @foreach ($caseStudies as $index => $caseStudy)
                                @include('frontend.case-studies._card', ['cs' => $caseStudy, 'delay' => ($index % 3) * 80])
                            @endforeach
                        </div>
                        <div class="mt-10">{{ $caseStudies->links() }}</div>
                    @else
                        <div class="rounded-2xl border border-ink-100 bg-white py-20 text-center">
                            <p class="text-lg text-ink-400">No case studies found. Try adjusting your filters.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
