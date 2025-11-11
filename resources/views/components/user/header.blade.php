<nav id="popup" x-data="{ mobileMenuOpen: false }"
    class="flex items-center justify-between px-6 py-4 border-b border-white dark:border-gray-700 sticky top-0 z-50 bg-white dark:bg-gray-800 shadow-md">

    {{-- JS: Deteksi URL real-time --}}

    <script>
        function isActive(path) {
            const current = window.location.pathname;
            if (path === '/') return current === '/';
            return current.startsWith(path);
        }
    </script>


    {{-- DESKTOP NAV --}}
    <div class="hidden md:flex items-center justify-between w-full">
        <div class="flex items-center space-x-2 flex-1">
            <a href="/" wire:navigate>
                <div class="p-2 rounded-lg">
                    <img src="{{ asset('images/logo-web.png') }}" alt="Logo HMI" class="w-10 h-10 filter">
                </div>
            </a>
            <a href="/" wire:navigate>
                <span class="text-xl font-bold">HMI CABANG PONOROGO</span>
            </a>
        </div>

        <div class="flex space-x-8 flex-1 justify-center">
            <a href="/" wire:navigate
                x-bind:class="isActive('/') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'">
                Home
            </a>

            {{-- Dropdown Blog --}}
            <div class="relative" x-data="{ openBlog: false }">
                <span @click="openBlog = !openBlog"
                    x-bind:class="isActive('/blog') || isActive('/categories/') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                    class="flex items-center cursor-pointer">
                    Blog
                    <i :class="{ 'rotate-180': openBlog }" class="fas fa-chevron-down ml-2 text-xs transition-transform"></i>
                </span>

                <div x-show="openBlog" x-cloak @click.away="openBlog = false"
                    class="absolute left-0 mt-2 w-56 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 z-50 max-h-96 overflow-y-auto">
                    <a href="{{ route('blog') }}" wire:navigate
                        class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-t-lg font-semibold border-b dark:border-gray-600">
                        Semua Artikel
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('categories.show', $category->slug) }}" wire:navigate
                            class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 {{ $loop->last ? 'rounded-b-lg' : '' }}">
                            <div class="flex items-center justify-between">
                                <span>{{ $category->name }}</span>
                                <span class="text-xs bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-0.5 rounded-full">
                                    {{ $category->posts_count }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Dropdown Profile --}}
            <div class="relative" x-data="{ openProfile: false }">
                <span @click="openProfile = !openProfile"
                    x-bind:class="isActive('/profile') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                    class="flex items-center cursor-pointer">
                    Profile
                    <i :class="{ 'rotate-180': openProfile }" class="fas fa-chevron-down ml-2 text-xs transition-transform"></i>
                </span>

                <div x-show="openProfile" x-cloak @click.away="openProfile = false"
                    class="absolute left-0 mt-2 w-56 bg-white border rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 z-50">
                    <a href="{{ route('profile.sejarah') }}" wire:navigate
                        class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-t-lg">
                        Sejarah
                    </a>
                    <a href="{{ route('profile.kepengurusan') }}" wire:navigate
                        class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-b-lg">
                        Susunan Kepengurusan
                    </a>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end flex-1">
            <button class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 transition-colors">
                <i class="fas fa-sun text-yellow-500 text-lg"></i>
            </button>
        </div>
    </div>

    {{-- MOBILE NAV --}}
    <div class="md:hidden flex items-center justify-between w-full">
        <div class="flex items-center">
            <a href="/" wire:navigate>
                <div class="p-2 rounded-lg">
                    <img src="{{ asset('images/logo-web.png') }}" alt="Logo HMI" class="w-10 h-10 filter">
                </div>
            </a>
        </div>

        <div class="flex gap-3 items-center">
            <button class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 transition-colors">
                <i class="fas fa-sun text-yellow-500 text-lg"></i>
            </button>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 dark:text-gray-300">
                <i x-show="!mobileMenuOpen" class="fas fa-bars text-xl"></i>
                <i x-show="mobileMenuOpen" class="fas fa-times text-xl"></i>
            </button>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false"
        class="md:hidden absolute top-16 left-0 w-full bg-white dark:bg-gray-800 shadow-lg border-t dark:border-gray-700 z-40">

        <a href="/" wire:navigate
            x-bind:class="isActive('/') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
            class="block p-4 border-b dark:border-gray-700">
            Home
        </a>

        <div class="border-b dark:border-gray-700" x-data="{ openBlogMobile: false }">
            <span @click="openBlogMobile = !openBlogMobile"
                x-bind:class="isActive('/blog') || isActive('/categories/') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                class="flex items-center justify-between p-4 cursor-pointer">
                Blog
                <i :class="{ 'rotate-180': openBlogMobile }" class="fas fa-chevron-down text-xs transition-transform"></i>
            </span>
            <div x-show="openBlogMobile" x-cloak class="bg-gray-50 dark:bg-gray-700 max-h-64 overflow-y-auto">
                <a href="{{ route('blog') }}" wire:navigate
                    class="block px-8 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 font-semibold border-b dark:border-gray-600">
                    Semua Artikel
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" wire:navigate
                        class="block px-8 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center justify-between">
                            <span>{{ $category->name }}</span>
                            <span class="text-xs bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-2 py-0.5 rounded-full">
                                {{ $category->posts_count }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="border-b dark:border-gray-700" x-data="{ openProfileMobile: false }">
            <span @click="openProfileMobile = !openProfileMobile"
                x-bind:class="isActive('/profile') ? 'text-green-600 dark:text-green-400 font-bold' : 'text-gray-600 dark:text-gray-300'"
                class="flex items-center justify-between p-4 cursor-pointer">
                Profile
                <i :class="{ 'rotate-180': openProfileMobile }" class="fas fa-chevron-down text-xs transition-transform"></i>
            </span>
            <div x-show="openProfileMobile" x-cloak class="bg-gray-50 dark:bg-gray-700 max-h-64 overflow-y-auto">
                <a href="{{ route('profile.sejarah') }}" wire:navigate
                    class="block px-8 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 font-semibold border-b dark:border-gray-600">
                    Sejarah
                </a>
                <a href="{{ route('profile.kepengurusan') }}" wire:navigate
                    class="block px-8 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 font-semibold">
                    Susunan Kepengurusan
                </a>
            </div>
        </div>
    </div>
</nav>
