@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Sectors"
        title="Industries"
        title-accent="We Serve"
        subtitle="Deep domain expertise across the sectors where infrastructure performance matters most."
        size="compact"
        :breadcrumbs="[['name' => 'Industries']]"
    />

    <section class="bg-surface py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($industries as $index => $industry)
                    @php
                        $iconName = $industry->icon ?: 'building';
                        $iconClass = \Illuminate\Support\Str::startsWith($iconName, 'fa-') ? $iconName : 'fa-'.$iconName;
                    @endphp
                    <a href="{{ route('industries.show', $industry->slug) }}"
                        class="wf-card group reveal p-6 text-center"
                        style="transition-delay: {{ ($index % 4) * 70 }}ms">
                        @if ($industry->featured_image)
                            <div class="media-frame mb-4 overflow-hidden rounded-xl">
                                <img src="{{ asset($industry->featured_image) }}" alt="{{ $industry->name }}" loading="lazy" class="h-32 w-full object-cover">
                            </div>
                        @endif
                        <div class="icon-tile mx-auto mb-3 flex h-12 w-12 items-center justify-center">
                            <i class="fa-solid {{ $iconClass }} text-xl"></i>
                        </div>
                        <h2 class="mb-2 font-heading text-base font-semibold text-ink-900 transition-colors group-hover:text-accent-600">{{ $industry->name }}</h2>
                        @if ($industry->description)
                            <p class="line-clamp-3 text-sm leading-relaxed text-ink-400">{{ $industry->description }}</p>
                        @endif
                        @if ($industry->case_studies_count ?? false)
                            <p class="mt-3 text-xs text-ink-400">{{ $industry->case_studies_count }} case {{ \Illuminate\Support\Str::plural('study', $industry->case_studies_count) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
