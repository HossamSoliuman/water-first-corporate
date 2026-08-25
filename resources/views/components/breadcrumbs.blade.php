@props(['items' => [], 'light' => false])

@php
    $baseText = $light ? 'text-primary-200' : 'text-ink-400';
    $linkHover = $light ? 'hover:text-white' : 'hover:text-accent-600';
    $currentText = $light ? 'text-white' : 'text-ink-800';
@endphp

<nav aria-label="Breadcrumb" class="text-sm {{ $baseText }}">
    <ol class="flex flex-wrap items-center gap-1.5">
        <li>
            <a href="{{ route('home') }}" class="transition-colors {{ $linkHover }}">Home</a>
        </li>
        @foreach ($items as $item)
            <li class="flex items-center gap-1.5">
                <svg class="h-4 w-4 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                @if (! $loop->last && isset($item['url']))
                    <a href="{{ $item['url'] }}" class="transition-colors {{ $linkHover }}">{{ $item['name'] }}</a>
                @else
                    <span class="font-medium {{ $currentText }}">{{ $item['name'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
