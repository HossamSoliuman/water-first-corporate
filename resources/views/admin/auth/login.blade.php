<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — WaterFirst</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={theme:{extend:{colors:{navy:{900:'#0d3041',950:'#081a24'},teal:{600:'#144a6a',500:'#19587f'},brown:{500:'#8e6b51',400:'#bf834e'}},fontFamily:{sans:['"DM Sans"','ui-sans-serif']}}}}</script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>body{font-family:'DM Sans',ui-sans-serif,system-ui;}</style>
</head>
<body class="h-full bg-navy-950 flex items-center justify-center p-4">

    <div class="w-full max-w-sm">
        <div class="text-center mb-8">
            <img src="{{ asset('images/waterfirst-logo.svg') }}" alt="WaterFirst" class="h-14 w-auto mx-auto mb-4 brightness-0 invert opacity-90">
            <p class="text-slate-400 text-sm tracking-widest uppercase">Admin Panel</p>
        </div>

        <div class="bg-white rounded-2xl shadow-2xl shadow-black/40 p-8">
            <h2 class="text-xl font-semibold text-navy-900 mb-6">Sign in to your account</h2>

            @if($errors->any())
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-xl p-3 text-sm">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition">
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-teal-500">
                    <span class="text-sm text-slate-600">Remember me</span>
                </label>
                <button type="submit" class="w-full bg-navy-900 text-white py-3 px-6 rounded-xl font-semibold hover:bg-teal-500 transition-colors duration-300 mt-2">
                    Sign In
                </button>
            </form>
        </div>

        <p class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-slate-500 hover:text-white text-sm transition-colors">← Back to website</a>
        </p>
    </div>
</body>
</html>
