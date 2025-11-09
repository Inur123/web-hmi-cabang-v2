<div>
    <x-layouts.app>

<div class="text-center py-10">
    <h1 class="text-3xl font-bold mb-4 text-gray-800">Selamat Datang di Halaman Utama</h1>
    <p class="text-gray-600 mb-6">
        Ini adalah halaman utama untuk pengguna dan pengunjung.
    </p>
    <a href="{{ route('login') }}" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        Login
    </a>
    <a href="{{ route('register') }}" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
        Register
    </a>
</div>
</x-layouts.app>
</div>
