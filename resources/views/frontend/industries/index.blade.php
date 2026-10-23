@extends('layouts.app')

@section('content')
    <x-page-hero
        eyebrow="Sectors"
        title="Industries"
        title-accent="we serve"
        size="compact"
        :breadcrumbs="[['name' => 'Industries']]"
    />

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid border-l border-t border-line sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($industries as $index => $industry)
                    @php
                        $iconName = $industry->icon ?: 'building';
                        $iconClass = \Illuminate\Support\Str::startsWith($iconName, 'fa-') ? $iconName : 'fa-'.$iconName;
                    @endphp
                    <a href="{{ route('industries.show', $industry->slug) }}"
                        class="group reveal flex flex-col border-b border-r border-line p-6 transition-colors hover:bg-surface"
                        style="transition-delay: {{ ($index % 4) * 70 }}ms">
                        @if ($industry->featured_image)
                            <div class="media-frame mb-5 aspect-[16/10] rounded">
                                <img src="{{ asset($industry->featured_image) }}" alt="" loading="lazy" class="h-full w-full object-cover">
                            </div>
                        @endif
                        <span class="flex h-11 w-11 items-center justify-center rounded bg-surface text-lg text-primary-600 transition-colors group-hover:bg-primary-600 group-hover:text-white">
                            <i class="fa-solid {{ $iconClass }}"></i>
                        </span>
                        <h2 class="mt-5 text-lg font-semibold text-ink-900">
                            <span class="underline-grow">{{ $industry->name }}</span>
                        </h2>
                        @if ($industry->description)
                            <p class="mt-2 line-clamp-3 flex-1 text-sm leading-6 text-ink-600">{{ $industry->description }}</p>
                        @endif
                        @if ($industry->case_studies_count ?? false)
                            <p class="mt-4 font-mono text-[11px] uppercase tracking-[.12em] text-accent-700">{{ $industry->case_studies_count }} case {{ \Illuminate\Support\Str::plural('study', $industry->case_studies_count) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
