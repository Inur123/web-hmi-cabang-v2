<aside class="w-64 bg-gray-800 text-gray-100 min-h-screen p-4">
    <h2 class="text-lg font-semibold mb-6">Menu</h2>
    <nav class="flex flex-col space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="px-3 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
           Dashboard
        </a>
        <a href="{{ route('home') }}"
           class="px-3 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('user.home') ? 'bg-gray-700' : '' }}">
           Halaman User
        </a>
    </nav>
</aside>
