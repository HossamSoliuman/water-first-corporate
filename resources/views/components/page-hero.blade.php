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
        'tall' => 'py-32',
        'compact' => 'py-20',
        default => 'py-28',
    };
    $titleSize = $size === 'compact' ? 'text-4xl md:text-5xl' : 'text-5xl md:text-6xl';
@endphp

<section class="relative overflow-hidden bg-primary-950 wf-texture {{ $padding }}">
    @if ($image)
        <img src="{{ $image }}" alt="" aria-hidden="true" class="absolute inset-0 h-full w-full object-cover opacity-30">
    @endif
    <div class="absolute inset-0 bg-gradient-to-br from-primary-950 via-primary-900/95 to-accent-950/40"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if (count($breadcrumbs))
            <x-breadcrumbs :items="$breadcrumbs" light />
        @endif

        <div class="mt-8 flex items-start gap-6">
            @if ($icon)
                <span class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-white/10 bg-accent-500/20 text-accent-300">
                    <x-icon name="{{ $icon }}" class="h-8 w-8" />
                </span>
            @endif

            <div class="max-w-3xl">
                @if ($eyebrow)
                    <p class="eyebrow eyebrow-light mb-4">{{ $eyebrow }}</p>
                @endif

                <h1 class="font-heading {{ $titleSize }} leading-tight text-white">
                    {{ $title }}@if ($titleAccent)<br><span class="text-accent-300">{{ $titleAccent }}</span>@endif
                </h1>

                @if ($subtitle)
                    <p class="mt-5 text-lg leading-relaxed text-primary-200">{{ $subtitle }}</p>
                @endif

                @if ($meta)
                    <div class="mt-6">{{ $meta }}</div>
                @endif

                {{ $slot }}
            </div>
        </div>
    </div>
</section>
