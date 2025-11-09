<header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="font-bold text-xl text-gray-800">Panel Admin</h1>
    <div class="flex items-center gap-4">
        <span class="text-gray-600">Halo, {{ Auth::user()->name }}</span>
        @livewire('auth.logout')
    </div>
</header>
