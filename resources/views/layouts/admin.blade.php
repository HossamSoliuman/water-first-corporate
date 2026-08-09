<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — WaterFirst</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy:  { 50:'#e8eef3',100:'#c5d5e0',200:'#9fb8c9',300:'#779bb3',400:'#4f7e9c',500:'#2e6485',600:'#1e4f6e',700:'#193d55',800:'#112d3f',900:'#0d3041',950:'#081a24' },
                        teal:  { 50:'#e6eff6',100:'#c0d6e9',200:'#96badb',300:'#6a9dce',400:'#3e7fbe',500:'#19587f',600:'#144a6a',700:'#0f3c56',800:'#092e42',900:'#06212f' },
                        brown: { 50:'#f5ede4',100:'#e8d4bf',200:'#dab898',300:'#cc9c71',400:'#bf834e',500:'#8e6b51',600:'#785840',700:'#62462f' },
                        slate: { 50:'#f4f6f7',100:'#e8edef',200:'#c1cfd2',300:'#a0b4b9',400:'#7d98a0',500:'#5e7f88',600:'#4a6870',700:'#385159',800:'#273b42',900:'#18272c' },
                    },
                    fontFamily: { sans: ['"Inter"','ui-sans-serif'], heading: ['"Poppins"','ui-sans-serif'] }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        [x-cloak]{display:none!important}
        body { font-family:'Inter',ui-sans-serif,system-ui; }
        h1,h2,h3,h4,h5,h6 { font-family:'Poppins',ui-sans-serif,system-ui; font-weight:700; }
        button,[type="button"],[type="submit"] { font-family:'Poppins',ui-sans-serif,system-ui; font-weight:500; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="h-full" x-data="{ sidebarOpen: false }">

<div class="min-h-full flex">
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 lg:hidden"></div>
    @include('admin.partials.sidebar')

    <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
        @include('admin.partials.topbar')
        <main class="flex-1 overflow-y-auto p-6">
            @include('admin.partials.flash')
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
