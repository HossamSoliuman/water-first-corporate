@props(['items' => [], 'light' => false])

@php
    $baseText = $light ? 'text-primary-200' : 'text-ink-500';
    $linkHover = $light ? 'hover:text-white' : 'hover:text-primary-600';
    $currentText = $light ? 'text-white' : 'text-ink-900';
@endphp

<nav aria-label="Breadcrumb" class="font-mono text-[11px] uppercase tracking-[.12em] {{ $baseText }}">
    <ol class="flex flex-wrap items-center gap-2">
        <li>
            <a href="{{ route('home') }}" class="transition-colors {{ $linkHover }}">Home</a>
        </li>
        @foreach ($items as $item)
            <li class="flex items-center gap-2">
                <span class="text-accent-500" aria-hidden="true">/</span>
                @if (! $loop->last && isset($item['url']))
                    <a href="{{ $item['url'] }}" class="transition-colors {{ $linkHover }}">{{ $item['name'] }}</a>
                @else
                    <span class="line-clamp-1 font-medium {{ $currentText }}">{{ $item['name'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
