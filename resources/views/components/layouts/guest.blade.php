<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'HMI Cabang Ponorogo')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-web.png') }}?v={{ time() }}" />

    <meta property="og:title" content="{{ $post->title ?? 'Default Title' }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($post->content ?? 'Default Description'), 150) }}">
    <meta property="og:image"
        content="{{ isset($post->thumbnail) ? asset('storage/' . $post->thumbnail) : asset('images/default-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">

    <!-- Dark Mode Script -->
    <script>
        if (localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles
</head>

<body class="min-h-screen bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100">

    <x-user.header />

    <main class="flex-1 p-6">
        {{ $slot }}
    </main>

    <x-user.footer />

    <!-- Tombol Scroll to Top -->
    <button id="scrollToTop"
        class="hidden fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-full shadow-lg transform transition-all duration-300 flex items-center justify-center z-50 group cursor-pointer">
        <svg class="w-6 h-6  transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    @livewireScripts
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        function initScrollButton() {
            const scrollBtn = document.getElementById('scrollToTop');
            if (!scrollBtn) return;

            // Tampilkan tombol ketika discroll ke bawah
            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    scrollBtn.classList.remove('hidden');
                    scrollBtn.classList.add('fade-in');
                } else {
                    scrollBtn.classList.add('hidden');
                }
            });

            // Klik tombol → scroll ke atas
            scrollBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                offset: 100,
                once: true
            });
            initScrollButton(); // ✅ inisialisasi pertama kali
        });

        // ✅ Re-init tombol + AOS setelah navigasi Livewire (SPA)
        document.addEventListener('livewire:navigated', () => {
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            AOS.refresh();
            initScrollButton(); // ✅ inisialisasi ulang tombol setelah pindah halaman
        });
    </script>


    <!-- Efek fade in untuk kemunculan tombol -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-in-out;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* Firefox */
        html {
            scrollbar-width: thin;
            scrollbar-color: #c1c1c1 #f1f1f1;
        }
    </style>
</body>

</html>
