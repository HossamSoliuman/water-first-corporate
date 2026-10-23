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
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@100..125,400..800&family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                        line: '#DCEAF3',
                        surface: '#F5FBFE'
                    },
                    fontFamily: {
                        sans: ['"IBM Plex Sans"', 'ui-sans-serif', 'system-ui'],
                        heading: ['"Archivo"', 'ui-sans-serif', 'system-ui'],
                        display: ['"Archivo"', 'ui-sans-serif', 'system-ui'],
                        mono: ['"IBM Plex Mono"', 'ui-monospace', 'monospace']
                    },
                    borderRadius: {
                        DEFAULT: '6px'
                    },
                    boxShadow: {
                        soft: '0 14px 36px -24px rgba(18, 50, 74, .35)'
                    }
                }
            }
        }
    </script>
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        [x-cloak] { display: none !important; }

        html { font-family: 'IBM Plex Sans', ui-sans-serif, system-ui; scroll-behavior: smooth; }
        body { background: #FFFFFF; color: #12324A; }

        h1, h2, h3, h4, h5, h6, .font-display, .font-heading {
            font-family: 'Archivo', ui-sans-serif, system-ui; font-stretch: 108%; letter-spacing: -.018em;
        }
        h1, h2 { font-weight: 650; }
        h1 { line-height: 1.04; letter-spacing: -.028em; }
        button, [type="button"], [type="submit"], [role="button"] { font-family: 'IBM Plex Sans', ui-sans-serif, system-ui; }
        ::selection { background: #00A6A6; color: #FFFFFF; }
        :focus-visible { outline: 2px solid #00A6A6; outline-offset: 3px; }

        .font-metric, .metric, [data-count-to] { font-family: 'IBM Plex Mono', ui-monospace, monospace; font-variant-numeric: tabular-nums; }
        .metric { color: #07579A; letter-spacing: -.03em; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

        .prose { color: #2D5367; }
        .prose a { color: #07579A; text-decoration-color: #00A6A6; text-underline-offset: 3px; }
        .prose h2, .prose h3, .prose h4 { color: #12324A; font-family: 'Archivo', ui-sans-serif, system-ui; font-stretch: 108%; }
        .prose img { border-radius: 6px; }
        .prose li::marker { color: #00A6A6; }

        /* ── Staff gauge: the measuring scale is the WaterFirst signature ── */
        .gauge-x {
            height: 12px; color: #9FC4D5;
            background-image:
                repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 50px),
                repeating-linear-gradient(90deg, currentColor 0 1px, transparent 1px 10px);
            background-size: 100% 12px, 100% 6px;
            background-position: 0 100%, 0 100%;
            background-repeat: no-repeat;
        }
        .gauge-y {
            width: 12px; color: #9FC4D5;
            background-image:
                repeating-linear-gradient(180deg, currentColor 0 1px, transparent 1px 50px),
                repeating-linear-gradient(180deg, currentColor 0 1px, transparent 1px 10px);
            background-size: 12px 100%, 6px 100%;
            background-position: 0 0, 0 0;
            background-repeat: no-repeat;
        }

        /* ── Eyebrow: a mono label sitting on a short gauge tick ───────── */
        .eyebrow {
            display: inline-flex; align-items: center; gap: .7rem;
            font-family: 'IBM Plex Mono', ui-monospace, monospace;
            font-size: .72rem; font-weight: 500; letter-spacing: .14em; text-transform: uppercase; color: #07579A;
        }
        .eyebrow::before {
            content: ''; width: 28px; height: 8px; flex: none;
            background: linear-gradient(#00A6A6, #00A6A6) 0 100% / 100% 2px no-repeat,
                repeating-linear-gradient(90deg, #00A6A6 0 1px, transparent 1px 7px) 0 0 / 100% 6px no-repeat;
        }
        .eyebrow-light { color: #A5F3F3; }
        .section-index { color: #008888; font-family: 'IBM Plex Mono', monospace; font-size: .75rem; font-weight: 500; letter-spacing: .1em; }

        /* ── Buttons: flat, squared, no sheen ─────────────────────────── */
        .wf-btn-primary, .wf-btn-deep, .wf-btn-light, .wf-btn-outline {
            display: inline-flex; align-items: center; justify-content: center; gap: .6rem;
            padding: .8rem 1.3rem; border-radius: 6px; border: 1px solid transparent;
            font-family: 'IBM Plex Sans', ui-sans-serif, system-ui; font-size: .9rem; font-weight: 600; line-height: 1.2;
            transition: background-color .2s ease, color .2s ease, border-color .2s ease;
        }
        .wf-btn-primary { background: #07579A; color: #FFFFFF; border-color: #07579A; }
        .wf-btn-primary:hover { background: #06497F; border-color: #06497F; }
        .wf-btn-deep { background: #12324A; color: #FFFFFF; border-color: #12324A; }
        .wf-btn-deep:hover { background: #07579A; border-color: #07579A; }
        .wf-btn-light { background: #FFFFFF; color: #07579A; border-color: #FFFFFF; }
        .wf-btn-light:hover { background: #ECFEFE; border-color: #ECFEFE; }
        .wf-btn-outline { background: transparent; color: #12324A; border-color: #C9DEE9; }
        .wf-btn-outline:hover { border-color: #00A6A6; color: #076C6C; }
        .wf-btn-outline-light { color: #FFFFFF !important; border-color: rgba(255, 255, 255, .4) !important; }
        .wf-btn-outline-light:hover { border-color: #FFFFFF !important; background: rgba(255, 255, 255, .08) !important; }

        /* ── Flat card ───────────────────────────────────────────────── */
        .wf-card {
            background: #FFFFFF; border: 1px solid #DCEAF3; border-radius: 6px;
            transition: transform .3s cubic-bezier(.16, 1, .3, 1), border-color .25s ease, box-shadow .3s ease;
        }
        .wf-card:hover { transform: translateY(-3px); border-color: #00A6A6; box-shadow: 0 14px 36px -24px rgba(18, 50, 74, .35); }

        .icon-tile {
            display: inline-flex; align-items: center; justify-content: center; flex: none;
            border-radius: 6px; border: 1px solid #DCEAF3; background: #FFFFFF; color: #07579A;
            transition: border-color .25s ease, color .25s ease;
        }
        .group:hover .icon-tile { border-color: #00A6A6; color: #008888; }
        .icon-tile-dark { background: rgba(7, 33, 57, .6); border-color: rgba(165, 243, 243, .35); color: #A5F3F3; }

        .technical-rule { border-left: 2px solid #00A6A6; }
        .interior-hero { position: relative; background: #F5FBFE; border-bottom: 1px solid #DCEAF3; }
        .interior-hero::after {
            content: ''; position: absolute; left: 0; right: 0; bottom: 0; height: 12px; pointer-events: none;
            background-image:
                repeating-linear-gradient(90deg, #9FC4D5 0 1px, transparent 1px 50px),
                repeating-linear-gradient(90deg, #9FC4D5 0 1px, transparent 1px 10px);
            background-size: 100% 12px, 100% 6px; background-position: 0 100%, 0 100%; background-repeat: no-repeat;
        }
        .deep-band { background: #07579A; color: #FFFFFF; }
        .sticky-label { position: sticky; top: 7rem; }

        .flow-lines { position: relative; isolation: isolate; }
        .flow-lines::before {
            content: ''; position: absolute; inset: 0; z-index: -1; pointer-events: none; opacity: .14;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='900' height='320' viewBox='0 0 900 320' fill='none'%3E%3Cg stroke='%2300A6A6'%3E%3Cpath d='M-20 70C120 10 190 135 340 74C490 13 555 125 710 67C785 39 840 42 930 82'/%3E%3Cpath d='M-20 112C115 52 208 171 350 111C488 53 570 161 720 104C800 73 858 79 930 118'/%3E%3Cpath d='M-20 154C130 93 213 213 365 150C503 93 596 203 742 145C820 114 865 121 930 155'/%3E%3Cpath d='M-20 197C125 136 220 254 375 192C514 136 603 245 755 188C824 162 872 161 930 194'/%3E%3C/g%3E%3C/svg%3E");
            background-position: right center; background-size: cover;
        }

        .hover-row { transition: background .25s ease; }
        .hover-row:hover { background: #F5FBFE; }
        .underline-grow {
            background-image: linear-gradient(#00A6A6, #00A6A6); background-repeat: no-repeat;
            background-position: 0 100%; background-size: 0 1px; transition: background-size .35s cubic-bezier(.16, 1, .3, 1);
        }
        .group:hover .underline-grow { background-size: 100% 1px; }

        /* ── Media ───────────────────────────────────────────────────── */
        .media-frame { overflow: hidden; background: #E5F0F6; }
        .media-frame img { transition: transform .7s cubic-bezier(.16, 1, .3, 1); }
        .group:hover .media-frame img, .media-frame:hover img { transform: scale(1.04); }
        .media-tint { background: rgba(7, 87, 154, .22); opacity: 0; transition: opacity .4s ease; }
        .group:hover .media-tint { opacity: 1; }

        /* ── Reveal animations ───────────────────────────────────────── */
        .reveal, .reveal-left, .reveal-right, .reveal-scale {
            opacity: 0; transition: opacity .6s cubic-bezier(.16, 1, .3, 1), transform .6s cubic-bezier(.16, 1, .3, 1);
        }
        .reveal { transform: translateY(20px); }
        .reveal-left { transform: translateX(-24px); }
        .reveal-right { transform: translateX(24px); }
        .reveal-scale { transform: scale(.97); }
        .reveal.is-visible, .reveal-left.is-visible, .reveal-right.is-visible, .reveal-scale.is-visible { opacity: 1; transform: none; }
        .delay-100 { transition-delay: .1s; } .delay-200 { transition-delay: .2s; } .delay-300 { transition-delay: .3s; }
        .delay-400 { transition-delay: .4s; } .delay-500 { transition-delay: .5s; } .delay-600 { transition-delay: .6s; }
        .delay-700 { transition-delay: .7s; }

        /* ── Header ──────────────────────────────────────────────────── */
        #site-header { transition: box-shadow .25s ease; }
        #site-header.scrolled { box-shadow: 0 10px 30px -24px rgba(18, 50, 74, .6); }

        /* ── Motion primitives ───────────────────────────────────────── */
        @keyframes arrow-nudge { 0%, 100% { transform: translateX(0); } 50% { transform: translateX(4px); } }
        @keyframes wf-flow { to { stroke-dashoffset: -220; } }
        @keyframes wf-draw { to { stroke-dashoffset: 0; } }
        @keyframes wf-pulse { 0%, 100% { opacity: .3; } 50% { opacity: 1; } }
        @keyframes wf-marquee-up { from { transform: translateY(0); } to { transform: translateY(-50%); } }
        @keyframes wf-level { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-6px); } }

        .group:hover .arrow-nudge { animation: arrow-nudge .5s ease-in-out; }
        .flow-stroke { stroke-dasharray: 8 10; animation: wf-flow 4s linear infinite; }
        .flow-stroke-slow { stroke-dasharray: 5 9; animation: wf-flow 7s linear infinite; }
        .draw-stroke { stroke-dasharray: 600; stroke-dashoffset: 600; }
        .is-visible .draw-stroke, .draw-stroke.is-visible { animation: wf-draw 2.2s cubic-bezier(.16, 1, .3, 1) forwards; }
        .pulse-node { animation: wf-pulse 2.8s ease-in-out infinite; }
        .water-level { animation: wf-level 6s ease-in-out infinite; }

        .marquee-vertical { -webkit-mask-image: linear-gradient(to bottom, transparent, #000 60px, #000 calc(100% - 60px), transparent); mask-image: linear-gradient(to bottom, transparent, #000 60px, #000 calc(100% - 60px), transparent); }
        .marquee-up { animation: wf-marquee-up 40s linear infinite; }
        .marquee-vertical:hover .marquee-up { animation-play-state: paused; }

        @media (prefers-reduced-motion: reduce) {
            .reveal, .reveal-left, .reveal-right, .reveal-scale { opacity: 1 !important; transform: none !important; transition: none !important; }
            .flow-stroke, .flow-stroke-slow, .pulse-node, .water-level, .draw-stroke, .is-visible .draw-stroke, .marquee-up, .arrow-nudge { animation: none !important; }
            .draw-stroke { stroke-dashoffset: 0 !important; }
            .media-frame img, .wf-card { transition: none !important; }
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

<body class="antialiased bg-white text-ink-800" x-data>
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

                const duration = 1600;
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
            window.addEventListener('scroll', () => header?.classList.toggle('scrolled', window.scrollY > 40), {passive: true});
        })();
    </script>
    @stack('scripts')
</body>

</html>
