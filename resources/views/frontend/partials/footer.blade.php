<footer class="border-t border-primary-700 bg-primary-600 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 py-16 md:grid-cols-2 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <img src="{{ asset('images/waterfirst-logo-white.svg') }}" alt="WaterFirst" class="h-12 w-auto">
                <p class="mt-5 max-w-sm text-sm leading-7 text-primary-100">Water-led engineering consultancy delivering sustainable, regulatory-compliant infrastructure from concept through operations.</p>
                <p class="mt-6 font-mono text-[11px] uppercase tracking-[.18em] text-accent-200">Engineering water, sustainably</p>
            </div>

            <div class="lg:col-span-3">
                <h2 class="font-mono text-[11px] uppercase tracking-[.18em] text-accent-200">Expertise</h2>
                <ul class="mt-5 grid gap-3">
                    @foreach ($footerServices->take(6) as $service)
                        <li><a href="{{ route('expertise.show', $service->slug) }}" class="text-sm text-primary-100 transition-colors hover:text-white">{{ $service->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="lg:col-span-2">
                <h2 class="font-mono text-[11px] uppercase tracking-[.18em] text-accent-200">Navigate</h2>
                <ul class="mt-5 grid gap-3">
                    @foreach ([['company-overview', 'Company'], ['expertise.index', 'Expertise'], ['case-studies.index', 'Projects'], ['insights.index', 'Insights'], ['careers', 'Careers'], ['contact', 'Contact']] as [$routeName, $label])
                        <li><a href="{{ route($routeName) }}" class="text-sm text-primary-100 transition-colors hover:text-white">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="lg:col-span-3">
                <h2 class="font-mono text-[11px] uppercase tracking-[.18em] text-accent-200">Bangalore office</h2>
                <div class="mt-5 grid gap-4 text-sm leading-6 text-primary-100">
                    <p>{{ $settings->get('address_india', 'Bangalore, Karnataka, India') }}</p>
                    @if ($settings->get('contact_email'))
                        <a href="mailto:{{ $settings->get('contact_email') }}" class="break-all hover:text-white">{{ $settings->get('contact_email') }}</a>
                    @endif
                    @if ($settings->get('phone'))
                        <a href="tel:{{ $settings->get('phone') }}" class="hover:text-white">{{ $settings->get('phone') }}</a>
                    @endif
                </div>
                <div class="mt-6 flex gap-3">
                    @foreach (['linkedin', 'twitter', 'facebook', 'instagram'] as $social)
                        @if ($settings->get("social_{$social}"))
                            <a href="{{ $settings->get("social_{$social}") }}" target="_blank" rel="noopener" class="flex h-9 w-9 items-center justify-center border border-primary-400 text-xs uppercase text-white hover:border-accent-300" aria-label="{{ ucfirst($social) }}">
                                {{ substr($social, 0, 1) }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 border-t border-primary-500 py-6 text-xs text-primary-100 md:flex-row md:items-center md:justify-between">
            <p>{!! $settings->get('footer_text', '© '.date('Y').' WaterFirst Engineering Consultancy Private Limited. All rights reserved.') !!}</p>
            <div class="flex flex-wrap gap-5">
                <a href="{{ route('page.show', 'privacy-policy') }}" class="hover:text-white">Privacy Policy</a>
                <a href="{{ route('page.show', 'terms-conditions') }}" class="hover:text-white">Terms &amp; Conditions</a>
                <a href="{{ route('sitemap') }}" class="hover:text-white">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
