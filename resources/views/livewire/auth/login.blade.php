<div>
    <!-- Flash Message Component -->


    <div class="text-center mb-6">
        <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Selamat Datang</h2>
        <p class="text-gray-600 mt-1">Masuk ke akunmu untuk melanjutkan</p>
    </div>
    @if (session()->has('success'))
        <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    <form id="login-form" class="space-y-5" autocomplete="on">
        <div>
            <label class="block text-gray-700 mb-1">Email</label>
            <input type="email" wire:model="email" name="email" autocomplete="email"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-800 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition"
                placeholder="email@example.com" required>
            @error('email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 mb-1">Password</label>
            <div class="relative">
                <input type="{{ $showPassword ? 'text' : 'password' }}" wire:model="password" name="password"
                    autocomplete="current-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-white text-gray-800 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 outline-none transition"
                    placeholder="••••••••" required>
                <button type="button" wire:click="togglePassword"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 cursor-pointer">
                    @if ($showPassword)
                        <i class="fas fa-eye-slash"></i>
                    @else
                        <i class="fas fa-eye"></i>
                    @endif
                </button>
            </div>
            @error('password')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- reCAPTCHA v3 error (jika ada) -->
        @error('recaptcha')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror

        <button type="button" id="login-btn"
            class="group relative w-full flex justify-center items-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-300 disabled:opacity-75 disabled:cursor-not-allowed cursor-pointer">
            <span class="btn-text">Masuk</span>
            <span class="btn-loading hidden flex items-center space-x-2">
                <i class="fa-solid fa-spinner fa-spin"></i>
                <span>Loading...</span>
            </span>
        </button>
    </form>

    <!-- reCAPTCHA v3 Script -->
    @script
        <script>
            const RECAPTCHA_SITE_KEY = "{{ config('services.recaptcha.site_key') }}";
            const MAX_RETRY = 10;

            // Fungsi untuk mendapatkan token reCAPTCHA v3
            function executeRecaptcha(attempt = 1) {
                return new Promise((resolve, reject) => {
                    if (typeof grecaptcha === 'undefined') {
                        if (attempt < MAX_RETRY) {
                            setTimeout(() => {
                                executeRecaptcha(attempt + 1).then(resolve).catch(reject);
                            }, 500);
                        } else {
                            reject('reCAPTCHA tidak dapat dimuat.');
                        }
                        return;
                    }

                    grecaptcha.ready(function() {
                        grecaptcha.execute(RECAPTCHA_SITE_KEY, {
                                action: 'login'
                            })
                            .then(resolve)
                            .catch(reject);
                    });
                });
            }

            // Handler untuk login button
            async function handleLoginClick(e) {
                e.preventDefault();
                const btn = e.currentTarget;
                const btnText = btn.querySelector('.btn-text');
                const btnLoading = btn.querySelector('.btn-loading');

                if (btn.disabled) return;

                try {
                    // Generate token di background TANPA loading (cepat & invisible)
                    const token = await executeRecaptcha();

                    // Set token
                    await $wire.set('recaptcha', token);

                    // BARU tampilkan loading saat proses login ke server
                    btn.disabled = true;
                    if (btnText) btnText.classList.add('hidden');
                    if (btnLoading) btnLoading.classList.remove('hidden');

                    // Call login
                    await $wire.call('login');

                    // Reset button setelah login (sukses atau gagal)
                    setTimeout(() => {
                        btn.disabled = false;
                        if (btnText) btnText.classList.remove('hidden');
                        if (btnLoading) btnLoading.classList.add('hidden');
                    }, 500);

                } catch (error) {
                    console.error('reCAPTCHA error:', error);
                    alert('Gagal memverifikasi reCAPTCHA: ' + error);
                    await $wire.set('recaptcha', null);

                    // Reset button
                    btn.disabled = false;
                    if (btnText) btnText.classList.remove('hidden');
                    if (btnLoading) btnLoading.classList.add('hidden');
                }
            }

            // Attach listener ke button
            function setupLoginButton() {
                const btn = document.getElementById('login-btn');
                if (!btn) return false;

                // Cek apakah sudah di-setup
                if (btn._recaptchaSetup) return true;

                btn.addEventListener('click', handleLoginClick);
                btn._recaptchaSetup = true;
                console.log('✅ Login button setup complete');
                return true;
            }

            // MutationObserver untuk detect button
            const observer = new MutationObserver(() => {
                if (setupLoginButton()) {
                    // Jangan disconnect, biarkan terus observe
                }
            });

            // Start observing
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });

            // Setup awal
            setupLoginButton();
        </script>
    @endscript
</div>
