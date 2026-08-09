@props(['items' => []])
<nav aria-label="Breadcrumb" class="font-mono text-[10px] uppercase tracking-[.14em] text-ink-500">
    <ol class="flex flex-wrap items-center gap-2">
        <li><a href="{{ route('home') }}" class="transition-colors hover:text-primary-600">Home</a></li>
        @foreach ($items as $item)
            <li class="flex items-center gap-2">
                <span class="text-accent-600">/</span>
                @if (! $loop->last && isset($item['url']))
                    <a href="{{ $item['url'] }}" class="transition-colors hover:text-primary-600">{{ $item['name'] }}</a>
                @else
                    <span class="font-semibold text-ink-800">{{ $item['name'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
