@php
    $aboutPages = [
        ['company-overview', '01', 'building-office-2', 'Company Overview', 'Who we are and the standard we hold.'],
        ['our-team', '02', 'users', 'Our Team', 'Senior engineers connected to every project.'],
        ['why-choose-us', '03', 'shield-check', 'Why Choose Us', 'Five commitments that shape our delivery.'],
        ['business-models', '04', 'scale', 'Business Models', 'Engagement structures for every project stage.'],
    ];
    $currentRoute = request()->route()?->getName();
@endphp

<section class="flow-lines bg-primary-600 py-14 md:py-16 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-12">
            <div class="reveal-left lg:col-span-4">
                <h2 class="text-3xl font-semibold leading-tight text-white">Continue through the practice.</h2>
                <a href="{{ route('contact') }}" class="wf-btn-light sheen group mt-8">
                    Talk to our engineers
                    <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                </a>
            </div>

            <div class="grid gap-px border border-primary-400 bg-primary-400 sm:grid-cols-2 lg:col-span-8">
                @foreach ($aboutPages as $index => [$routeName, $number, $icon, $label, $description])
                    @php($isCurrent = $currentRoute === $routeName)
                    <a
                        href="{{ route($routeName) }}"
                        @if ($isCurrent) aria-current="page" @endif
                        class="group flex min-h-40 flex-col justify-between p-7 transition-colors reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }} {{ $isCurrent ? 'bg-primary-700' : 'bg-primary-600 hover:bg-primary-700' }}"
                    >
                        <div class="flex items-center justify-between">
                            <span class="icon-tile icon-tile-dark h-11 w-11"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                            <span class="font-mono text-xs text-accent-200">{{ $number }}</span>
                        </div>
                        <div class="mt-7">
                            <p class="font-heading text-lg font-medium leading-7 text-white">
                                <span class="underline-grow">{{ $label }}</span>
                            </p>
                            <p class="mt-2 text-sm leading-6 text-primary-100">{{ $description }}</p>
                        </div>
                        <span class="mt-5 flex items-center gap-2 font-mono text-[10px] uppercase tracking-[.16em] text-accent-200">
                            {{ $isCurrent ? 'You are here' : 'Read more' }}
                            @unless ($isCurrent)
                                <x-icon name="arrow-long-right" class="h-3.5 w-3.5 arrow-nudge" />
                            @endunless
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
