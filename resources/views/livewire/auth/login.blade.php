<div>
    <div class="text-center mb-6">
        <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight"> Selamat Datang </h2>
        <p class="text-gray-600 mt-1"> Masuk ke akunmu untuk melanjutkan </p>
    </div> <!-- Pesan sukses atau error -->
    @if (session()->has('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm border border-green-300">
            {{ session('success') }} </div>
        @endif @if (session()->has('error'))
            <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm border border-red-300">
                {{ session('error') }} </div>
        @endif
        <form wire:submit.prevent="login" class="space-y-5">
            <div> <label class="block text-gray-700 mb-1">Email</label> <input type="email" wire:model="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-800 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition"
                    placeholder="email@example.com" required> @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div> <label class="block text-gray-700 mb-1">Password</label>
                <div class="relative"> <input type="{{ $showPassword ? 'text' : 'password' }}" wire:model="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-800 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition"
                        placeholder="••••••••" required> <button type="button" wire:click="togglePassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 cursor-pointer">
                        @if ($showPassword)
                            <i class="fas fa-eye-slash"></i>
                        @else
                            <i class="fas fa-eye"></i>
                        @endif
                    </button> </div> @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div wire:ignore>
                <div id="recaptcha-box"></div>
            </div> @error('recaptcha')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror <button type="submit" wire:loading.attr="disabled" wire:target="login"
                class="group relative w-full flex justify-center items-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-300 disabled:opacity-75 disabled:cursor-not-allowed cursor-pointer">
                <span wire:loading.remove wire:target="login">Masuk</span> <span wire:loading wire:target="login"
                    class="flex items-center space-x-2"> <i class="fa-solid fa-spinner fa-spin"></i>
                    <span>Loading...</span> </span> </button>
        </form>
        <script>
            let recaptchaWidgetId = null;
            let recaptchaInterval = null;

            function tryRenderRecaptcha() {
                // Tunggu sampai grecaptcha siap
                if (typeof grecaptcha === 'undefined' || !document.getElementById('recaptcha-box')) {
                    return;
                }

                // Jangan render dua kali
                if (recaptchaWidgetId !== null) return;

                recaptchaWidgetId = grecaptcha.render('recaptcha-box', {
                    sitekey: "{{ config('services.recaptcha.site_key') }}",
                    callback: token => {
                        @this.set('recaptcha', token);
                    }
                });

                // Stop polling
                clearInterval(recaptchaInterval);
                recaptchaInterval = null;
            }

            function startRecaptcha() {
                // Bersihkan dulu
                recaptchaWidgetId = null;
                const box = document.getElementById('recaptcha-box');
                if (box) box.innerHTML = '';

                // Coba tiap 300ms sampai grecaptcha siap
                recaptchaInterval = setInterval(tryRenderRecaptcha, 300);
            }

            // 🔑 SPA navigation (logout → login, dll)
            document.addEventListener('livewire:navigated', () => {
                startRecaptcha();
            });

            // 🔑 Load pertama
            document.addEventListener('DOMContentLoaded', () => {
                startRecaptcha();
            });

            // 🔑 Reset dari backend
            window.addEventListener('grecaptcha-reset', () => {
                startRecaptcha();
            });
        </script>

</div>
