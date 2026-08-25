<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('frontend.partials.seo')

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="16x16 32x32 48x48">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#EFF8FF', 100: '#D9EEFF', 200: '#B7DFFF', 300: '#7CC6F4', 400: '#3FA9DE',
                            500: '#1686C4', 600: '#07579A', 700: '#06497F', 800: '#083D68', 900: '#0B3457', 950: '#072139'
                        },
                        secondary: {
                            50: '#F0F8FD', 100: '#DDEEF9', 200: '#BEDFF2', 300: '#90C9E8', 400: '#55A9D8',
                            500: '#1976B8', 600: '#1567A1', 700: '#135383', 800: '#14466D', 900: '#153B5B', 950: '#0E263D'
                        },
                        accent: {
                            50: '#ECFEFE', 100: '#D0FAFA', 200: '#A5F3F3', 300: '#67E5E5', 400: '#22CCCC',
                            500: '#00A6A6', 600: '#008888', 700: '#076C6C', 800: '#0B5656', 900: '#0D4747', 950: '#052C2C'
                        },
                        ink: {
                            50: '#F3F8FB', 100: '#E5F0F6', 200: '#C9DEE9', 300: '#9FC4D5', 400: '#6FA2BA',
                            500: '#4B829D', 600: '#38677F', 700: '#2D5367', 800: '#12324A', 900: '#0B2437', 950: '#061722'
                        },
                        surface: '#F5FBFE'
                    },
                    fontFamily: {
                        sans: ['"Inter"', 'ui-sans-serif', 'system-ui'],
                        heading: ['"Sora"', 'ui-sans-serif', 'system-ui'],
                        display: ['"Sora"', 'ui-sans-serif', 'system-ui']
                    },
                    boxShadow: {
                        soft: '0 20px 48px -24px rgba(11, 36, 55, .22)'
                    }
                }
            }
        }
    </script>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        [x-cloak] { display: none !important; }

        html { font-family: 'Inter', ui-sans-serif, system-ui; scroll-behavior: smooth; }
        body { background: #FFFFFF; color: #0B2437; }

        h1, h2, h3, h4 { font-family: 'Sora', ui-sans-serif, system-ui; font-weight: 700; letter-spacing: -.025em; }
        h1 { font-weight: 700; line-height: 1.08; letter-spacing: -.035em; }
        .font-display, .font-heading { font-family: 'Sora', ui-sans-serif, system-ui; }
        button, [type="button"], [type="submit"], [role="button"], a[class*="btn"] { font-family: 'Sora', ui-sans-serif, system-ui; font-weight: 600; }
        ::selection { background: #00A6A6; color: #FFFFFF; }

        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

        .prose { color: #38677F; }
        .prose a { color: #07579A; }
        .prose h2, .prose h3, .prose h4 { font-family: 'Sora', ui-sans-serif, system-ui; font-weight: 700; color: #0B2437; }
        .prose img { border-radius: .75rem; }
        .prose li::marker { color: #00A6A6; }

        /* ── Section eyebrow ─────────────────────────────────────────── */
        .eyebrow {
            display: block; font-family: 'Sora', ui-sans-serif, system-ui;
            font-size: .75rem; font-weight: 600; letter-spacing: .14em;
            text-transform: uppercase; color: #1976B8;
        }
        .eyebrow-light { color: #67E5E5; }

        /* ── Buttons ─────────────────────────────────────────────────── */
        a.wf-btn-primary, button.wf-btn-primary,
        a.wf-btn-deep, button.wf-btn-deep,
        a.wf-btn-light, button.wf-btn-light,
        a.wf-btn-outline, button.wf-btn-outline {
            position: relative; overflow: hidden;
            display: inline-flex; align-items: center; justify-content: center; gap: .65rem;
            padding: .9rem 1.75rem; border-radius: .75rem;
            font-family: 'Sora', ui-sans-serif, system-ui; font-size: .9rem; font-weight: 600;
            transition: transform .3s cubic-bezier(.16, 1, .3, 1), box-shadow .3s ease, filter .3s ease, background .3s ease, color .3s ease, border-color .3s ease;
        }

        /* Glossy accent — primary call to action */
        a.wf-btn-primary, button.wf-btn-primary {
            background: linear-gradient(180deg, #22CCCC 0%, #00A6A6 52%, #076C6C 100%);
            color: #FFFFFF; border: 1px solid rgba(255, 255, 255, .14);
            box-shadow: 0 10px 24px -8px rgba(7, 108, 108, .55),
                inset 0 1px 0 rgba(255, 255, 255, .36),
                inset 0 -1px 0 rgba(0, 0, 0, .18);
        }
        a.wf-btn-primary::before, button.wf-btn-primary::before {
            content: ''; position: absolute; inset: 0 0 55% 0; pointer-events: none;
            background: linear-gradient(180deg, rgba(255, 255, 255, .32), rgba(255, 255, 255, 0));
        }
        a.wf-btn-primary:hover, button.wf-btn-primary:hover {
            transform: translateY(-1px); filter: brightness(1.06);
            box-shadow: 0 16px 32px -8px rgba(7, 108, 108, .62),
                inset 0 1px 0 rgba(255, 255, 255, .46),
                inset 0 -1px 0 rgba(0, 0, 0, .2);
        }

        /* Glossy deep blue — secondary call to action */
        a.wf-btn-deep, button.wf-btn-deep {
            background: linear-gradient(180deg, #1686C4 0%, #07579A 55%, #06497F 100%);
            color: #FFFFFF; border: 1px solid rgba(255, 255, 255, .12);
            box-shadow: 0 10px 24px -8px rgba(7, 33, 57, .55),
                inset 0 1px 0 rgba(255, 255, 255, .22),
                inset 0 -1px 0 rgba(0, 0, 0, .25);
        }
        a.wf-btn-deep::before, button.wf-btn-deep::before {
            content: ''; position: absolute; inset: 0 0 55% 0; pointer-events: none;
            background: linear-gradient(180deg, rgba(255, 255, 255, .2), rgba(255, 255, 255, 0));
        }
        a.wf-btn-deep:hover, button.wf-btn-deep:hover { transform: translateY(-1px); filter: brightness(1.1); }

        /* Light — used on deep backgrounds */
        a.wf-btn-light, button.wf-btn-light {
            background: #FFFFFF; color: #07579A; border: 1px solid #FFFFFF;
            box-shadow: 0 10px 24px -10px rgba(7, 33, 57, .45);
        }
        a.wf-btn-light:hover, button.wf-btn-light:hover { transform: translateY(-1px); background: #ECFEFE; border-color: #ECFEFE; }

        /* Outline — quiet tertiary action */
        a.wf-btn-outline, button.wf-btn-outline {
            background: transparent; color: #0B2437; border: 1px solid rgba(11, 36, 55, .2);
        }
        a.wf-btn-outline:hover, button.wf-btn-outline:hover { transform: translateY(-1px); border-color: #00A6A6; color: #076C6C; background: #ECFEFE; }
        .wf-btn-outline-light { color: #FFFFFF !important; border-color: rgba(255, 255, 255, .35) !important; }
        .wf-btn-outline-light:hover { background: rgba(255, 255, 255, .12) !important; color: #FFFFFF !important; border-color: rgba(255, 255, 255, .6) !important; }

        /* ── Light card ──────────────────────────────────────────────── */
        .wf-card {
            background: #FFFFFF; border: 1px solid #E5F0F6; border-radius: 1rem;
            transition: transform .3s cubic-bezier(.16, 1, .3, 1), box-shadow .3s ease, border-color .3s ease;
        }
        .wf-card:hover { transform: translateY(-6px); border-color: #C9DEE9; box-shadow: 0 20px 48px rgba(11, 36, 55, .12); }
        .wf-card .icon-tile { transition: background .3s ease, color .3s ease, border-color .3s ease; }
        .wf-card:hover .icon-tile { background: #00A6A6; border-color: #00A6A6; color: #FFFFFF; }
        .wf-card .arrow-wrap { opacity: 0; transform: translateX(-6px); transition: opacity .3s ease, transform .3s ease; }
        .wf-card:hover .arrow-wrap { opacity: 1; transform: translateX(0); }

        /* ── Deep panel (soft-glass) ─────────────────────────────────── */
        .wf-panel.wf-panel {
            position: relative; overflow: hidden; border-radius: 1rem;
            background: linear-gradient(155deg, #0B3457 0%, #083D68 45%, #072139 100%);
            border: 1px solid rgba(255, 255, 255, .08);
            box-shadow: 0 22px 50px -16px rgba(6, 23, 34, .55), inset 0 1px 0 rgba(255, 255, 255, .06);
            color: #C9DEE9;
        }
        .wf-panel::before {
            content: ''; position: absolute; inset: 0; z-index: 0; pointer-events: none;
            background: radial-gradient(115% 80% at 0% 0%, rgba(255, 255, 255, .1), rgba(255, 255, 255, 0) 55%);
        }
        .wf-panel::after {
            content: ''; position: absolute; left: 0; right: 0; bottom: 0; height: 2px; z-index: 0; pointer-events: none;
            background: linear-gradient(90deg, transparent, rgba(0, 166, 166, .95), transparent); opacity: .6;
        }
        .wf-panel > * { position: relative; z-index: 1; }
        a.wf-panel { transition: transform .4s cubic-bezier(.16, 1, .3, 1), box-shadow .4s ease; }
        a.wf-panel:hover { transform: translateY(-6px); box-shadow: 0 32px 60px -18px rgba(6, 23, 34, .7), inset 0 1px 0 rgba(255, 255, 255, .08); }

        .wf-chip {
            display: inline-flex; align-items: center; justify-content: center; flex: none;
            background: rgba(255, 255, 255, .08); border: 1px solid rgba(255, 255, 255, .12);
            color: #67E5E5; border-radius: .75rem;
            transition: background .3s ease, color .3s ease, border-color .3s ease;
        }
        .group:hover .wf-chip, a.wf-panel:hover .wf-chip { background: #00A6A6; border-color: #00A6A6; color: #FFFFFF; }

        /* ── Icon tile (light surfaces) ──────────────────────────────── */
        .icon-tile {
            display: inline-flex; align-items: center; justify-content: center; flex: none;
            background: #ECFEFE; border: 1px solid #D0FAFA; color: #008888; border-radius: .75rem;
            transition: background .3s ease, color .3s ease, border-color .3s ease, transform .3s cubic-bezier(.16, 1, .3, 1);
        }
        .group:hover .icon-tile, .icon-tile:hover { background: #00A6A6; border-color: #00A6A6; color: #FFFFFF; }
        .icon-tile-deep { background: #07579A; border-color: #07579A; color: #FFFFFF; }
        .group:hover .icon-tile-deep { background: #00A6A6; border-color: #00A6A6; }

        /* ── Water-line texture (the WaterFirst signature) ───────────── */
        .wf-texture::after {
            content: ''; position: absolute; inset: 0; z-index: 0; pointer-events: none; opacity: .5;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='1200' height='400' viewBox='0 0 1200 400' fill='none'%3E%3Cg stroke='%2300A6A6' stroke-opacity='.16' stroke-width='1.2'%3E%3Cpath d='M-40 90C160 20 260 160 460 92C660 24 760 164 960 96C1100 50 1180 56 1260 96'/%3E%3Cpath d='M-40 150C160 80 260 220 460 152C660 84 760 224 960 156C1100 110 1180 116 1260 156'/%3E%3Cpath d='M-40 210C160 140 260 280 460 212C660 144 760 284 960 216C1100 170 1180 176 1260 216'/%3E%3Cpath d='M-40 270C160 200 260 340 460 272C660 204 760 344 960 276C1100 230 1180 236 1260 276'/%3E%3Cpath d='M-40 330C160 260 260 400 460 332C660 264 760 404 960 336C1100 290 1180 296 1260 336'/%3E%3C/g%3E%3C/svg%3E");
            background-position: center; background-size: cover;
        }
        .wf-texture-light::after { opacity: 1; }

        /* ── Media ───────────────────────────────────────────────────── */
        .media-frame { overflow: hidden; background: #072139; }
        .media-frame img { transition: transform .7s cubic-bezier(.16, 1, .3, 1); will-change: transform; }
        .group:hover .media-frame img, .media-frame:hover img { transform: scale(1.06); }
        .media-veil { background: linear-gradient(to top, rgba(7, 33, 57, .92) 0%, rgba(7, 33, 57, .35) 55%, rgba(7, 33, 57, 0) 100%); }

        /* ── Reveal animations ───────────────────────────────────────── */
        .reveal, .reveal-left, .reveal-right, .reveal-scale {
            opacity: 0; transition: opacity .65s cubic-bezier(.16, 1, .3, 1), transform .65s cubic-bezier(.16, 1, .3, 1);
        }
        .reveal { transform: translateY(28px); }
        .reveal-left { transform: translateX(-32px); }
        .reveal-right { transform: translateX(32px); }
        .reveal-scale { transform: scale(.94); }
        .reveal.is-visible, .reveal-left.is-visible, .reveal-right.is-visible, .reveal-scale.is-visible { opacity: 1; transform: none; }
        .delay-100 { transition-delay: .1s; } .delay-200 { transition-delay: .2s; } .delay-300 { transition-delay: .3s; }
        .delay-400 { transition-delay: .4s; } .delay-500 { transition-delay: .5s; } .delay-600 { transition-delay: .6s; }
        .delay-700 { transition-delay: .7s; }

        /* ── Header ──────────────────────────────────────────────────── */
        #site-header { transition: box-shadow .3s ease; }
        #site-header.scrolled { box-shadow: 0 4px 24px rgba(11, 36, 55, .13); }

        /* ── Motion primitives ───────────────────────────────────────── */
        @keyframes wf-ripple { 0%, 100% { opacity: .18; transform: scale(1); } 50% { opacity: .38; transform: scale(1.08); } }
        @keyframes arrow-nudge { 0%, 100% { transform: translateX(0); } 50% { transform: translateX(4px); } }
        @keyframes wf-float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-9px); } }
        @keyframes wf-bob { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(6px); } }
        @keyframes wf-flow { to { stroke-dashoffset: -220; } }
        @keyframes wf-draw { to { stroke-dashoffset: 0; } }
        @keyframes wf-pulse { 0%, 100% { opacity: .25; transform: scale(1); } 50% { opacity: .9; transform: scale(1.5); } }
        @keyframes wf-marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        @keyframes wf-marquee-up { from { transform: translateY(0); } to { transform: translateY(-50%); } }

        .ripple-pulse { animation: wf-ripple 4s ease-in-out infinite; }
        .group:hover .arrow-nudge { animation: arrow-nudge .5s ease-in-out; }
        .float-slow { animation: wf-float 7s ease-in-out infinite; }
        .scroll-cue { animation: wf-bob 2.2s ease-in-out infinite; }
        .flow-stroke { stroke-dasharray: 8 10; animation: wf-flow 4s linear infinite; }
        .flow-stroke-slow { stroke-dasharray: 5 9; animation: wf-flow 7s linear infinite; }
        .draw-stroke { stroke-dasharray: 600; stroke-dashoffset: 600; }
        .is-visible .draw-stroke, .draw-stroke.is-visible { animation: wf-draw 2.2s cubic-bezier(.16, 1, .3, 1) forwards; }
        .pulse-node { transform-box: fill-box; transform-origin: center; animation: wf-pulse 2.8s ease-in-out infinite; }

        .marquee { overflow: hidden; -webkit-mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); }
        .marquee-track { display: flex; width: max-content; animation: wf-marquee 38s linear infinite; }
        .marquee:hover .marquee-track { animation-play-state: paused; }
        .marquee-vertical { -webkit-mask-image: linear-gradient(to bottom, transparent, #000 60px, #000 calc(100% - 60px), transparent); mask-image: linear-gradient(to bottom, transparent, #000 60px, #000 calc(100% - 60px), transparent); }
        .marquee-up { animation: wf-marquee-up 40s linear infinite; }
        .marquee-vertical:hover .marquee-up { animation-play-state: paused; }

        @media (prefers-reduced-motion: reduce) {
            .reveal, .reveal-left, .reveal-right, .reveal-scale { opacity: 1 !important; transform: none !important; transition: none !important; }
            .ripple-pulse, .float-slow, .scroll-cue, .flow-stroke, .flow-stroke-slow, .pulse-node,
            .draw-stroke, .is-visible .draw-stroke, .marquee-track, .marquee-up { animation: none !important; }
            .draw-stroke { stroke-dashoffset: 0 !important; }
            .media-frame img { transition: none !important; }
            * { scroll-behavior: auto !important; }
        }
    </style>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    @stack('styles')

    @if ($settings->get('gtm_id'))
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
                const f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l !== 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ $settings->get('gtm_id') }}');
        </script>
    @endif

    <script type="application/ld+json">{!! app(\App\Services\SeoService::class)->generateJsonLdOrganization() !!}</script>
</head>

<body class="antialiased bg-white text-ink-900" x-data>
    @if ($settings->get('gtm_id'))
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings->get('gtm_id') }}" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif

    @include('frontend.partials.header')

    <main>@yield('content')</main>

    @include('frontend.partials.footer')
    @include('frontend.partials.whatsapp-float')

    @if ($settings->get('ga4_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->get('ga4_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', '{{ $settings->get('ga4_id') }}');
        </script>
    @endif

    <script>
        (() => {
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, {threshold: .12});

            document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale,.draw-stroke').forEach((element) => revealObserver.observe(element));

            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

            const countUp = (element) => {
                const target = parseFloat(element.dataset.countTo);
                const decimals = parseInt(element.dataset.countDecimals ?? '0', 10);
                const prefix = element.dataset.countPrefix ?? '';
                const suffix = element.dataset.countSuffix ?? '';
                const render = (value) => element.textContent = prefix + value.toFixed(decimals) + suffix;

                if (Number.isNaN(target) || reducedMotion.matches) {
                    render(target || 0);

                    return;
                }

                const duration = 1800;
                const start = performance.now();
                const step = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    render(target * (1 - Math.pow(1 - progress, 3)));

                    if (progress < 1) {
                        requestAnimationFrame(step);
                    }
                };

                requestAnimationFrame(step);
            };

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        countUp(entry.target);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, {threshold: .5});

            document.querySelectorAll('[data-count-to]').forEach((element) => counterObserver.observe(element));

            const header = document.getElementById('site-header');
            window.addEventListener('scroll', () => header?.classList.toggle('scrolled', window.scrollY > 60), {passive: true});
        })();
    </script>
    @stack('scripts')
</body>

</html>
