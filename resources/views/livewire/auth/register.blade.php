<!-- filepath: resources/views/livewire/auth/register.blade.php -->
<div>
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
        Buat Akun Baru
    </h2>

    <form wire:submit.prevent="register" class="space-y-5">
        <div>
            <label class="block text-gray-700 mb-1 font-medium">Nama Lengkap</label>
            <input type="text" wire:model="name"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="Masukkan nama lengkap" required>
            @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1 font-medium">Email</label>
            <input type="email" wire:model="email"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="Masukkan email aktif" required>
            @error('email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1 font-medium">Password</label>
            <input type="password" wire:model="password"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="Minimal 6 karakter" required>
            @error('password')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1 font-medium">Konfirmasi Password</label>
            <input type="password" wire:model="password_confirmation"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="Ulangi password" required>
            @error('password_confirmation')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:target="register"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 disabled:opacity-75 disabled:cursor-not-allowed">
            <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
            <span wire:loading wire:target="register" class="flex items-center">
               <i class="fa-solid fa-spinner fa-spin"></i>
            </span>
        </button>

        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun?
            <a wire:navigate href="{{ route('login') }}"
                class="text-blue-600 hover:text-blue-700 font-medium hover:underline">
                Masuk di sini
            </a>
        </p>
    </form>
</div>
