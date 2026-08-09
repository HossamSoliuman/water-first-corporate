@php($index = $index ?? null)
<a href="{{ route('case-studies.show', $cs->slug) }}" class="wf-card group flex flex-col overflow-hidden reveal">
    @if ($cs->featured_image)
        <img src="{{ asset($cs->featured_image) }}" alt="{{ $cs->title }}" class="aspect-[4/3] w-full border-b border-ink-200 object-cover" loading="lazy">
    @else
        <div class="flex aspect-[4/3] items-center justify-center border-b border-ink-200 bg-primary-50 flow-lines">
            <x-icon name="building-office-2" class="h-14 w-14 text-primary-200" />
        </div>
    @endif
    <div class="flex flex-1 flex-col p-6">
        <div class="flex items-center justify-between gap-4">
            @if ($cs->industry)<span class="font-mono text-[9px] uppercase tracking-[.14em] text-primary-600">{{ $cs->industry->name }}</span>@endif
            @if ($index)<span class="section-index">{{ str_pad($index, 2, '0', STR_PAD_LEFT) }}</span>@endif
        </div>
        <h2 class="mt-5 flex-1 text-lg font-semibold leading-snug text-ink-800 group-hover:text-primary-600"><span class="font-metric">{{ $cs->title }}</span></h2>
        @if ($cs->client_name)<p class="mt-4 border-t border-ink-100 pt-4 text-xs leading-5 text-ink-500"><span class="font-semibold text-ink-700">Client / partner</span><br>{{ $cs->client_name }}</p>@endif
        <div class="mt-5 flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-primary-600">Project detail <x-icon name="arrow-long-right" class="h-4 w-4" /></div>
    </div>
</a>
