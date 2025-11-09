<!-- filepath: resources/views/livewire/auth/login.blade.php -->
<div>
    <div class="text-center mb-6">
        <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">
            Selamat Datang
        </h2>
        <p class="text-gray-600 mt-1">
            Masuk ke akunmu untuk melanjutkan
        </p>
    </div>
    <form wire:submit.prevent="login" class="space-y-5">
        <div>
            <label class="block text-gray-700 mb-1">Email</label>
            <input type="email" wire:model="email"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                placeholder="email@example.com" required>
            @error('email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Password</label>
            <input type="password" wire:model="password"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                placeholder="••••••••" required>
            @error('password')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" wire:target="login"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 disabled:opacity-75 disabled:cursor-not-allowed">
            <span wire:loading.remove wire:target="login">Masuk</span>
            <span wire:loading wire:target="login" class="flex items-center">
               <i class="fa-solid fa-spinner fa-spin"></i>
            </span>
        </button>

        <p class="text-center text-sm text-gray-600 mt-4">
            Belum punya akun?
            <a wire:navigate href="{{ route('register') }}"
                class="text-blue-600 font-semibold hover:underline">
                Daftar Sekarang
            </a>
        </p>
    </form>
</div>
