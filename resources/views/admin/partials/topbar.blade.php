{{-- admin/partials/topbar.blade.php --}}
<header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between shrink-0">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <h1 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
    </div>

    <div class="flex items-center gap-4">
        <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-red-600 transition-colors">Logout</button>
        </form>
    </div>
</header>
