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
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Inter:wght@300;400;500;600;700&family=Sora:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                        display: ['"Sora"', 'ui-sans-serif', 'system-ui'],
                        mono: ['"IBM Plex Mono"', 'ui-monospace', 'monospace']
                    },
                    boxShadow: {
                        soft: '0 18px 50px -30px rgba(18, 50, 74, .35)'
                    }
                }
            }
        }
    </script>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        [x-cloak] { display: none !important; }
        html { font-family: 'Inter', ui-sans-serif, system-ui; scroll-behavior: smooth; }
        body { background: #F5FBFE; color: #12324A; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Sora', ui-sans-serif, system-ui; letter-spacing: -.035em; }
        button, [type="button"], [type="submit"], [role="button"] { font-family: 'Sora', ui-sans-serif, system-ui; }
        ::selection { background: #00A6A6; color: #FFFFFF; }

        .font-metric, .count-up, [data-capacity] { font-family: 'IBM Plex Mono', ui-monospace, monospace; font-variant-numeric: tabular-nums; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .prose { color: #2D5367; }
        .prose a { color: #07579A; text-decoration-color: #00A6A6; }
        .prose h2, .prose h3, .prose h4 { color: #12324A; font-family: 'Sora', ui-sans-serif, system-ui; }
        .prose img { border-radius: .375rem; }

        .wf-card {
            background: #FFFFFF;
            border: 1px solid #C9DEE9;
            border-radius: .5rem;
            box-shadow: 0 18px 50px -30px rgba(18, 50, 74, .35);
            transition: transform .3s cubic-bezier(.16, 1, .3, 1), border-color .3s ease, box-shadow .3s ease;
        }
        .wf-card:hover { transform: translateY(-3px); border-color: #00A6A6; box-shadow: 0 24px 58px -30px rgba(18, 50, 74, .45); }
        .wf-btn-primary, .wf-btn-outline, .wf-btn-light {
            display: inline-flex; align-items: center; justify-content: center; gap: .65rem;
            border-radius: .25rem; padding: .85rem 1.25rem; font-family: 'Sora', sans-serif;
            font-size: .875rem; font-weight: 600; transition: transform .2s ease, background .2s ease, color .2s ease, border-color .2s ease;
        }
        .wf-btn-primary { background: #07579A; color: #FFFFFF; border: 1px solid #07579A; }
        .wf-btn-primary:hover { background: #1976B8; border-color: #1976B8; transform: translateY(-2px); }
        .wf-btn-outline { background: transparent; color: #07579A; border: 1px solid #00A6A6; }
        .wf-btn-outline:hover { background: #ECFEFE; transform: translateY(-2px); }
        .wf-btn-light { background: #FFFFFF; color: #07579A; border: 1px solid #FFFFFF; }
        .wf-btn-light:hover { background: #D9EEFF; border-color: #D9EEFF; transform: translateY(-2px); }

        .section-index { color: #00A6A6; font-family: 'IBM Plex Mono', monospace; font-size: .75rem; font-weight: 600; letter-spacing: .12em; }
        .technical-rule { border-left: 3px solid #00A6A6; }
        .metric { font-family: 'IBM Plex Mono', monospace; color: #07579A; letter-spacing: -.04em; }
        .flow-lines { position: relative; isolation: isolate; }
        .flow-lines::before {
            content: ''; position: absolute; inset: 0; z-index: -1; pointer-events: none; opacity: .12;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='900' height='320' viewBox='0 0 900 320' fill='none'%3E%3Cpath d='M-20 70C120 10 190 135 340 74C490 13 555 125 710 67C785 39 840 42 930 82' stroke='%2300A6A6'/%3E%3Cpath d='M-20 112C115 52 208 171 350 111C488 53 570 161 720 104C800 73 858 79 930 118' stroke='%2300A6A6'/%3E%3Cpath d='M-20 154C130 93 213 213 365 150C503 93 596 203 742 145C820 114 865 121 930 155' stroke='%2300A6A6'/%3E%3Cpath d='M-20 197C125 136 220 254 375 192C514 136 603 245 755 188C824 162 872 161 930 194' stroke='%2300A6A6'/%3E%3C/svg%3E");
            background-position: center; background-size: cover;
        }
        .interior-hero { background: #F5FBFE; border-bottom: 1px solid #C9DEE9; }
        .deep-band { background: #07579A; color: #FFFFFF; }
        .sticky-label { position: sticky; top: 6rem; }

        .reveal, .reveal-left, .reveal-right, .reveal-scale { opacity: 0; transition: opacity .65s cubic-bezier(.16, 1, .3, 1), transform .65s cubic-bezier(.16, 1, .3, 1); }
        .reveal { transform: translateY(24px); }
        .reveal-left { transform: translateX(-28px); }
        .reveal-right { transform: translateX(28px); }
        .reveal-scale { transform: scale(.97); }
        .reveal.is-visible, .reveal-left.is-visible, .reveal-right.is-visible, .reveal-scale.is-visible { opacity: 1; transform: none; }
        .delay-100 { transition-delay: .1s; } .delay-200 { transition-delay: .2s; } .delay-300 { transition-delay: .3s; }
        .delay-400 { transition-delay: .4s; } .delay-500 { transition-delay: .5s; } .delay-600 { transition-delay: .6s; }
        #site-header { transition: box-shadow .25s ease; }
        #site-header.scrolled { box-shadow: 0 12px 35px -28px rgba(18, 50, 74, .7); }
        @keyframes arrow-nudge { 0%, 100% { transform: translateX(0); } 50% { transform: translateX(4px); } }
        .group:hover .arrow-nudge { animation: arrow-nudge .5s ease-in-out; }

        /* ── Icon tiles ─────────────────────────────────────────────── */
        .icon-tile {
            display: inline-flex; align-items: center; justify-content: center; flex: none;
            border: 1px solid #A5F3F3; color: #008888; background: #ECFEFE;
            transition: background .3s ease, color .3s ease, border-color .3s ease, transform .3s cubic-bezier(.16, 1, .3, 1);
        }
        .group:hover .icon-tile, .icon-tile:hover { background: #00A6A6; border-color: #00A6A6; color: #FFFFFF; transform: translateY(-2px); }
        .icon-tile-dark { border-color: rgba(103, 229, 229, .45); background: rgba(7, 33, 57, .55); color: #A5F3F3; }
        .group:hover .icon-tile-dark { background: #00A6A6; border-color: #00A6A6; color: #FFFFFF; }
        .icon-tile-solid { border-color: #07579A; background: #07579A; color: #FFFFFF; }
        .group:hover .icon-tile-solid { background: #00A6A6; border-color: #00A6A6; }

        /* ── Media ──────────────────────────────────────────────────── */
        .media-frame { overflow: hidden; background: #072139; }
        .media-frame img { transition: transform .8s cubic-bezier(.16, 1, .3, 1), opacity .5s ease; will-change: transform; }
        .group:hover .media-frame img, .media-frame:hover img { transform: scale(1.06); }
        .media-veil { background: linear-gradient(to top, rgba(7, 33, 57, .92) 0%, rgba(7, 33, 57, .45) 45%, rgba(7, 33, 57, 0) 100%); }
        .media-tint { background: rgba(7, 87, 154, .28); opacity: 0; transition: opacity .45s ease; }
        .group:hover .media-tint { opacity: 1; }

        /* ── Motion primitives ──────────────────────────────────────── */
        @keyframes wf-float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-9px); } }
        @keyframes wf-bob { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(6px); } }
        @keyframes wf-flow { to { stroke-dashoffset: -220; } }
        @keyframes wf-draw { to { stroke-dashoffset: 0; } }
        @keyframes wf-pulse { 0%, 100% { opacity: .25; transform: scale(1); } 50% { opacity: .9; transform: scale(1.5); } }
        @keyframes wf-spin { to { transform: rotate(360deg); } }
        @keyframes wf-marquee { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        @keyframes wf-sheen { 0% { transform: translateX(-120%); } 60%, 100% { transform: translateX(220%); } }
        @keyframes wf-caret { 0%, 45% { opacity: 1; } 55%, 100% { opacity: 0; } }

        .type-caret {
            display: inline-block; width: .055em; min-width: 2px; height: .82em;
            margin-left: .07em; vertical-align: -.04em; background: #67E5E5;
            animation: wf-caret 1.05s steps(1, end) infinite;
        }

        .float-slow { animation: wf-float 7s ease-in-out infinite; }
        .flow-stroke { stroke-dasharray: 8 10; animation: wf-flow 4s linear infinite; }
        .flow-stroke-slow { stroke-dasharray: 5 9; animation: wf-flow 7s linear infinite; }
        .draw-stroke { stroke-dasharray: 600; stroke-dashoffset: 600; }
        .is-visible .draw-stroke, .draw-stroke.is-visible { animation: wf-draw 2.2s cubic-bezier(.16, 1, .3, 1) forwards; }
        .pulse-node { transform-box: fill-box; transform-origin: center; animation: wf-pulse 2.8s ease-in-out infinite; }
        .spin-ring { transform-box: fill-box; transform-origin: center; animation: wf-spin 26s linear infinite; }
        .scroll-cue { animation: wf-bob 2.2s ease-in-out infinite; }

        .sheen { position: relative; overflow: hidden; }
        .sheen::after {
            content: ''; position: absolute; inset: 0 auto 0 0; width: 45%; pointer-events: none;
            background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .28), transparent);
            transform: translateX(-120%);
        }
        .group:hover .sheen::after, .sheen:hover::after { animation: wf-sheen 1.1s ease-out; }

        .marquee { overflow: hidden; -webkit-mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); }
        .marquee-track { display: flex; width: max-content; animation: wf-marquee 38s linear infinite; }
        .marquee:hover .marquee-track { animation-play-state: paused; }

        .hover-row { transition: background .3s ease; }
        .hover-row > * { transition: transform .35s cubic-bezier(.16, 1, .3, 1); }
        .hover-row:hover { background: #F3F8FB; }
        .hover-row:hover > * { transform: translateX(.3rem); }
        .underline-grow {
            padding-bottom: .15rem;
            background-image: linear-gradient(#00A6A6, #00A6A6);
            background-repeat: no-repeat; background-position: 0 100%; background-size: 0 2px;
            transition: background-size .35s cubic-bezier(.16, 1, .3, 1);
        }
        .group:hover .underline-grow { background-size: 100% 2px; }

        @media (prefers-reduced-motion: reduce) {
            .reveal, .reveal-left, .reveal-right, .reveal-scale { opacity: 1 !important; transform: none !important; transition: none !important; }
            .float-slow, .flow-stroke, .flow-stroke-slow, .pulse-node, .spin-ring, .scroll-cue, .marquee-track,
            .draw-stroke, .is-visible .draw-stroke, .sheen::after, .type-caret { animation: none !important; }
            .type-caret { opacity: 0 !important; }
            .draw-stroke { stroke-dashoffset: 0 !important; }
            .media-frame img, .hover-row > *, .underline-grow { transition: none !important; }
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

<body class="antialiased bg-surface text-ink-800" x-data>
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

            document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale').forEach((element) => revealObserver.observe(element));

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

                const duration = 1400;
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
            }, {threshold: .6});

            document.querySelectorAll('[data-count-to]').forEach((element) => counterObserver.observe(element));

            const header = document.getElementById('site-header');
            window.addEventListener('scroll', () => header?.classList.toggle('scrolled', window.scrollY > 50), {passive: true});
        })();
    </script>
    @stack('scripts')
</body>
</html>
