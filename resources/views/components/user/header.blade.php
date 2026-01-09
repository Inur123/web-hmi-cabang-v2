<nav id="popup" x-data="{
    mobileMenuOpen: false,
    darkMode: localStorage.theme === 'dark',

    isActive(path) {
        return window.location.pathname === path;
    },
    isBlogActive() {
        return window.location.pathname.startsWith('/blog') ||
            window.location.pathname.startsWith('/categories');
    },
    isProfileActive() {
        return window.location.pathname.startsWith('/profile');
    },

    // ✅ Sama seperti Blog/Profile: kalau submenu layanan aktif, label 'Layanan' ikut aktif
    isLayananActive() {
        return window.location.pathname.startsWith('/layanan') ||
               window.location.pathname === '{{ parse_url(route('permohonan'), PHP_URL_PATH) }}';
    },

    toggleDarkMode() {
        this.darkMode = !this.darkMode;
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        }
    }
}" x-init="// Sync state saat component init
darkMode = localStorage.theme === 'dark';

// Listen untuk perubahan dari tab lain
window.addEventListener('storage', (e) => {
    if (e.key === 'theme') {
        darkMode = e.newValue === 'dark';
    }
});

// Listen untuk Livewire navigate
document.addEventListener('livewire:navigated', () => {
    darkMode = localStorage.theme === 'dark';
});"
class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50 bg-white dark:bg-gray-800 shadow-md transition-colors duration-200">

    {{-- ================= DESKTOP NAV ================= --}}
    <div class="hidden md:flex items-center justify-between w-full">
        <div class="flex items-center space-x-2 flex-1">
            <a href="/" wire:navigate>
                <div class="p-2 rounded-lg">
                    <img src="{{ asset('images/logo-cabang-v2.webp') }}" alt="Logo HMI" class="w-10 h-10 filter">
                </div>
            </a>
            <a href="/" wire:navigate>
                <span class="text-xl font-bold bg-gradient-to-r from-green-600 via-green-500 to-yellow-400 text-transparent bg-clip-text">
                    HMI CABANG PONOROGO
                </span>
            </a>
        </div>

        <div class="flex space-x-8 flex-1 justify-center">
            <a href="/" wire:navigate
               x-bind:class="isActive('/') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
               class="transition-colors duration-200">
                Home
            </a>

            {{-- ================= BLOG ================= --}}
            <div class="relative" x-data="{ openBlog: false }">
                <span @click="openBlog = !openBlog"
                      x-bind:class="isBlogActive() ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                      class="flex items-center cursor-pointer transition-colors duration-200">
                    Blog
                    <i :class="{ 'rotate-180': openBlog }"
                       class="fas fa-chevron-down ml-2 text-xs transition-transform duration-200"></i>
                </span>

                <div x-show="openBlog" x-cloak @click.away="openBlog = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 max-h-80 overflow-hidden">

                    <div class="overflow-y-auto max-h-80">
                        <a href="{{ route('blog') }}" wire:navigate
                           x-bind:class="isActive('{{ parse_url(route('blog'), PHP_URL_PATH) }}') ? 'bg-green-50 dark:bg-green-900/30' : ''"
                           class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-semibold border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
                            Semua Artikel
                        </a>

                        @foreach ($allCategories as $category)
                            <a href="{{ route('categories.show', $category->slug) }}" wire:navigate
                               x-bind:class="isActive('{{ parse_url(route('categories.show', $category->slug), PHP_URL_PATH) }}') ? 'bg-green-50 dark:bg-green-900/30' : ''"
                               class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 {{ !$loop->last ? 'border-b border-gray-200 dark:border-gray-700' : '' }}">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="truncate">{{ $category->name }}</span>
                                    <span class="text-xs bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-1.5 py-0.5 rounded-full font-medium flex-shrink-0">
                                        {{ $category->posts_count }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>

            {{-- ================= PROFILE ================= --}}
            <div class="relative" x-data="{ openProfile: false }">
                <span @click="openProfile = !openProfile"
                      x-bind:class="isProfileActive() ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                      class="flex items-center cursor-pointer transition-colors duration-200">
                    Profile
                    <i :class="{ 'rotate-180': openProfile }"
                       class="fas fa-chevron-down ml-2 text-xs transition-transform duration-200"></i>
                </span>

                <div x-show="openProfile" x-cloak @click.away="openProfile = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute left-0 mt-2 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 overflow-hidden">

                    <a href="{{ route('profile.sejarah') }}" wire:navigate
                       x-bind:class="isActive('{{ parse_url(route('profile.sejarah'), PHP_URL_PATH) }}') ? 'bg-green-50 dark:bg-green-900/30' : ''"
                       class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
                        Sejarah
                    </a>

                    <a href="{{ route('profile.kepengurusan') }}" wire:navigate
                       x-bind:class="isActive('{{ parse_url(route('profile.kepengurusan'), PHP_URL_PATH) }}') ? 'bg-green-50 dark:bg-green-900/30' : ''"
                       class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        Susunan Kepengurusan
                    </a>
                </div>
            </div>

            {{-- ================= LAYANAN (SAMA SEPERTI BLOG/PROFILE) ================= --}}
            <div class="relative" x-data="{ openLayanan: false }">
                <span @click="openLayanan = !openLayanan"
                      x-bind:class="isLayananActive() ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                      class="flex items-center cursor-pointer transition-colors duration-200">
                    Layanan
                    <i :class="{ 'rotate-180': openLayanan }"
                       class="fas fa-chevron-down ml-2 text-xs transition-transform duration-200"></i>
                </span>

                <div x-show="openLayanan" x-cloak @click.away="openLayanan = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute left-0 mt-2 w-56 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 overflow-hidden">

                    <a href="/layanan/pedoman-administrasi" wire:navigate
                       x-bind:class="isActive('/layanan/pedoman-administrasi') ? 'bg-green-50 dark:bg-green-900/30' : ''"
                       class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
                        Pedoman Administrasi
                    </a>

                    <a href="{{ route('permohonan') }}" wire:navigate
                       x-bind:class="isActive('{{ parse_url(route('permohonan'), PHP_URL_PATH) }}') ? 'bg-green-50 dark:bg-green-900/30' : ''"
                       class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        Permohonan
                    </a>
                </div>
            </div>

            <a href="{{ route('komisariat.index') }}" wire:navigate
               x-bind:class="isActive('{{ parse_url(route('komisariat.index'), PHP_URL_PATH) }}') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
               class="transition-colors duration-200">
                Komisariat
            </a>

            <a href="{{ route('aduan') }}" wire:navigate
               x-bind:class="isActive('{{ parse_url(route('aduan'), PHP_URL_PATH) }}') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
               class="transition-colors duration-200">
                Aduan
            </a>
        </div>

        <div class="flex items-center justify-end flex-1">
            {{-- Dark Mode Toggle (Desktop) --}}
            <button @click="toggleDarkMode()"
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
                    title="Toggle Dark Mode">
                {{-- SUN --}}
                <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>

                {{-- MOON --}}
                <svg x-show="darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="currentColor" class="w-6 h-6 text-gray-200 transition-all duration-300">
                    <path fill-rule="evenodd"
                          d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z"
                          clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    {{-- ================= MOBILE NAV ================= --}}
    <div class="md:hidden flex items-center justify-between w-full">
        <div class="flex items-center space-x-2">
            <a href="/" wire:navigate class="flex items-center space-x-2">
                <img src="{{ asset('images/logo-cabang-v2.webp') }}" alt="Logo HMI" class="w-10 h-10">
                <span class="text-sm font-bold leading-tight bg-gradient-to-r from-green-600 via-green-500 to-yellow-400 text-transparent bg-clip-text">
                    HMI <br> PONOROGO
                </span>
            </a>
        </div>

        <div class="flex gap-3 items-center">
            {{-- Dark Mode Toggle (Mobile) --}}
            <button @click="toggleDarkMode()"
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200"
                    title="Toggle Dark Mode">
                {{-- SUN --}}
                <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 transition-all duration-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                </svg>

                {{-- MOON --}}
                <svg x-show="darkMode" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                     fill="currentColor" class="w-6 h-6 text-gray-200 transition-all duration-300">
                    <path fill-rule="evenodd"
                          d="M9.528 1.718a.75.75 0 0 1 .162.819A8.97 8.97 0 0 0 9 6a9 9 0 0 0 9 9 8.97 8.97 0 0 0 3.463-.69.75.75 0 0 1 .981.98 10.503 10.503 0 0 1-9.694 6.46c-5.799 0-10.5-4.7-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 0 1 .818.162Z"
                          clip-rule="evenodd" />
                </svg>
            </button>

            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 dark:text-gray-300">
                <i x-show="!mobileMenuOpen" class="fas fa-bars text-xl"></i>
                <i x-show="mobileMenuOpen" class="fas fa-times text-xl"></i>
            </button>
        </div>
    </div>

    {{-- ================= MOBILE MENU ================= --}}
    <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden absolute top-16 left-0 w-full bg-white dark:bg-gray-800 shadow-lg border-t border-gray-200 dark:border-gray-700 z-40">

        <a href="/" wire:navigate
           x-bind:class="isActive('/') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
           class="block p-4 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
            Home
        </a>

        {{-- BLOG MOBILE --}}
        <div class="border-b border-gray-200 dark:border-gray-700" x-data="{ openBlogMobile: false }">
            <span @click="openBlogMobile = !openBlogMobile"
                  x-bind:class="isBlogActive() ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                  class="flex items-center justify-between p-4 cursor-pointer transition-colors duration-200">
                Blog
                <i :class="{ 'rotate-180': openBlogMobile }" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
            </span>

            <div x-show="openBlogMobile" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 max-h-0"
                 x-transition:enter-end="opacity-100 max-h-96"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 max-h-96"
                 x-transition:leave-end="opacity-0 max-h-0"
                 class="bg-gray-50 dark:bg-gray-700/50 max-h-64 overflow-y-auto">

                <a href="{{ route('blog') }}" wire:navigate
                   x-bind:class="isActive('{{ parse_url(route('blog'), PHP_URL_PATH) }}') ? 'bg-green-100 dark:bg-green-800/50' : ''"
                   class="block px-8 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 font-semibold border-b border-gray-200 dark:border-gray-600 transition-colors duration-200">
                    Semua Artikel
                </a>

                @foreach ($allCategories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" wire:navigate
                       x-bind:class="isActive('{{ parse_url(route('categories.show', $category->slug), PHP_URL_PATH) }}') ? 'bg-green-100 dark:bg-green-800/50' : ''"
                       class="block px-8 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 {{ !$loop->last ? 'border-b border-gray-200 dark:border-gray-600' : '' }}">
                        <div class="flex items-center justify-between gap-2">
                            <span class="truncate">{{ $category->name }}</span>
                            <span class="text-xs bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-1.5 py-0.5 rounded-full font-medium flex-shrink-0">
                                {{ $category->posts_count }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- PROFILE MOBILE --}}
        <div class="border-b border-gray-200 dark:border-gray-700" x-data="{ openProfileMobile: false }">
            <span @click="openProfileMobile = !openProfileMobile"
                  x-bind:class="isProfileActive() ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                  class="flex items-center justify-between p-4 cursor-pointer transition-colors duration-200">
                Profile
                <i :class="{ 'rotate-180': openProfileMobile }" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
            </span>

            <div x-show="openProfileMobile" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 max-h-0"
                 x-transition:enter-end="opacity-100 max-h-96"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 max-h-96"
                 x-transition:leave-end="opacity-0 max-h-0"
                 class="bg-gray-50 dark:bg-gray-700/50 max-h-64 overflow-y-auto">

                <a href="{{ route('profile.sejarah') }}" wire:navigate
                   x-bind:class="isActive('{{ parse_url(route('profile.sejarah'), PHP_URL_PATH) }}') ? 'bg-green-100 dark:bg-green-800/50' : ''"
                   class="block px-8 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 font-semibold border-b border-gray-200 dark:border-gray-600 transition-colors duration-200">
                    Sejarah
                </a>

                <a href="{{ route('profile.kepengurusan') }}" wire:navigate
                   x-bind:class="isActive('{{ parse_url(route('profile.kepengurusan'), PHP_URL_PATH) }}') ? 'bg-green-100 dark:bg-green-800/50' : ''"
                   class="block px-8 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 font-semibold transition-colors duration-200">
                    Susunan Kepengurusan
                </a>
            </div>
        </div>

        {{-- LAYANAN MOBILE (sama pola Blog/Profile) --}}
        <div class="border-b border-gray-200 dark:border-gray-700" x-data="{ openLayananMobile: false }">
            <span @click="openLayananMobile = !openLayananMobile"
                  x-bind:class="isLayananActive() ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                  class="flex items-center justify-between p-4 cursor-pointer transition-colors duration-200">
                Layanan
                <i :class="{ 'rotate-180': openLayananMobile }" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
            </span>

            <div x-show="openLayananMobile" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 max-h-0"
                 x-transition:enter-end="opacity-100 max-h-96"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 max-h-96"
                 x-transition:leave-end="opacity-0 max-h-0"
                 class="bg-gray-50 dark:bg-gray-700/50 max-h-64 overflow-y-auto">

                <a href="/layanan/pedoman-administrasi" wire:navigate
                   x-bind:class="isActive('/layanan/pedoman-administrasi') ? 'bg-green-100 dark:bg-green-800/50' : ''"
                   class="block px-8 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 font-semibold border-b border-gray-200 dark:border-gray-600 transition-colors duration-200">
                    Pedoman Administrasi
                </a>

                <a href="{{ route('permohonan') }}" wire:navigate
                   x-bind:class="isActive('{{ parse_url(route('permohonan'), PHP_URL_PATH) }}') ? 'bg-green-100 dark:bg-green-800/50' : ''"
                   class="block px-8 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 font-semibold transition-colors duration-200">
                    Permohonan
                </a>
            </div>
        </div>

        <a href="{{ route('komisariat.index') }}" wire:navigate
           x-bind:class="isActive('{{ parse_url(route('komisariat.index'), PHP_URL_PATH) }}') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
           class="block p-4 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
            Komisariat
        </a>

        <a href="{{ route('aduan') }}" wire:navigate
           x-bind:class="isActive('{{ parse_url(route('aduan'), PHP_URL_PATH) }}') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
           class="block p-4 transition-colors duration-200">
            Aduan
        </a>
    </div>
</nav>
