@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-20 md:py-28"><div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"><x-breadcrumbs :items="[['name' => 'Case Studies']]" /><div class="mt-12 grid gap-10 lg:grid-cols-12"><div class="lg:col-span-3"><p class="section-kicker">01 — Project record</p></div><div class="lg:col-span-8"><h1 class="text-5xl font-semibold leading-[1.05] text-ink-800 md:text-7xl">Evidence in the field.</h1><p class="mt-7 max-w-3xl text-lg leading-8 text-ink-500">Selected municipal and industrial water assignments, from feasibility and detailed engineering to EPC support and long-term operations.</p></div></div></div></section>

    <section class="bg-surface py-20">
        <div class="mx-auto flex max-w-7xl flex-col gap-10 px-4 sm:px-6 lg:flex-row lg:px-8">
            <aside class="w-full shrink-0 lg:w-64">
                <form method="GET" action="{{ route('case-studies.index') }}" class="sticky-label border border-ink-200 bg-white p-5">
                    <div class="flex items-center justify-between border-b border-ink-200 pb-4"><h2 class="font-mono text-[10px] uppercase tracking-[.15em] text-primary-600">Filter projects</h2>@if (request()->hasAny(['category', 'industry']))<a href="{{ route('case-studies.index') }}" class="text-[10px] font-semibold text-accent-700">Clear</a>@endif</div>
                    @if ($categories->count())
                        <fieldset class="mt-5"><legend class="text-xs font-semibold uppercase tracking-wider text-ink-700">Category</legend><div class="mt-3 grid gap-2">@foreach ($categories as $category)<label class="flex cursor-pointer items-center gap-2 text-sm text-ink-600"><input type="radio" name="category" value="{{ $category->slug }}" @checked(request('category') === $category->slug) class="text-accent-600 focus:ring-accent-500" onchange="this.form.submit()"><span>{{ $category->name }}</span><span class="ml-auto font-mono text-[10px] text-ink-400">{{ $category->case_studies_count }}</span></label>@endforeach</div></fieldset>
                    @endif
                    <fieldset class="mt-6 border-t border-ink-100 pt-5"><legend class="text-xs font-semibold uppercase tracking-wider text-ink-700">Industry</legend><div class="mt-3 grid gap-2">@foreach ($industries as $industry)<label class="flex cursor-pointer items-center gap-2 text-sm text-ink-600"><input type="radio" name="industry" value="{{ $industry->slug }}" @checked(request('industry') === $industry->slug) class="text-accent-600 focus:ring-accent-500" onchange="this.form.submit()"><span>{{ $industry->name }}</span><span class="ml-auto font-mono text-[10px] text-ink-400">{{ $industry->case_studies_count }}</span></label>@endforeach</div></fieldset>
                </form>
            </aside>
            <div class="flex-1">
                @if ($caseStudies->count())
                    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">@foreach ($caseStudies as $index => $caseStudy)@include('frontend.case-studies._card', ['cs' => $caseStudy, 'index' => $caseStudies->firstItem() + $index])@endforeach</div>
                    <div class="mt-10">{{ $caseStudies->links() }}</div>
                @else
                    <div class="technical-rule bg-white p-8 text-ink-500">No projects match those filters.</div>
                @endif
            </div>
        </div>
    </section>
@endsection
