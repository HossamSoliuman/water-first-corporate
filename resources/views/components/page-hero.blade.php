@props([
    'eyebrow' => null,
    'title' => '',
    'titleAccent' => null,
    'subtitle' => null,
    'breadcrumbs' => [],
    'image' => null,
    'icon' => null,
    'size' => 'default',
    'meta' => null,
])

@php
    $padding = match ($size) {
        'tall' => 'pt-10 pb-20 md:pb-24',
        'compact' => 'pt-8 pb-12 md:pb-14',
        default => 'pt-10 pb-16 md:pb-20',
    };
    $titleSize = $size === 'compact' ? 'text-[clamp(2rem,4vw,3.25rem)]' : 'text-[clamp(2.4rem,5vw,4.25rem)]';
@endphp

<section class="relative overflow-hidden border-b border-line bg-surface">
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 {{ $padding }}">
        @if (count($breadcrumbs))
            <x-breadcrumbs :items="$breadcrumbs" />
        @endif

        <div class="mt-10 grid gap-8 lg:grid-cols-12 lg:items-end">
            <div class="{{ $subtitle || $image ? 'lg:col-span-7' : 'lg:col-span-10' }}">
                @if ($eyebrow || $icon)
                    <div class="mb-5 flex items-center gap-4">
                        @if ($icon)
                            <span class="icon-tile h-11 w-11"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                        @endif
                        @if ($eyebrow)
                            <p class="eyebrow">{{ $eyebrow }}</p>
                        @endif
                    </div>
                @endif

                <h1 class="{{ $titleSize }} text-ink-900">
                    {{ $title }}@if ($titleAccent) <span class="text-primary-600">{{ $titleAccent }}</span>@endif
                </h1>

                @if ($meta)
                    <div class="mt-6">{{ $meta }}</div>
                @endif

                {{ $slot }}
            </div>

            @if ($image)
                <div class="lg:col-span-5">
                    <div class="media-frame aspect-[4/3] rounded">
                        <img src="{{ $image }}" alt="" aria-hidden="true" class="h-full w-full object-cover">
                    </div>
                    @if ($subtitle)
                        <p class="mt-5 text-base leading-7 text-ink-600">{{ $subtitle }}</p>
                    @endif
                </div>
            @elseif ($subtitle)
                <p class="border-l-2 border-accent-500 pl-5 text-lg leading-8 text-ink-600 lg:col-span-5">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
    <div class="gauge-x mx-auto max-w-7xl" aria-hidden="true"></div>
</section>
