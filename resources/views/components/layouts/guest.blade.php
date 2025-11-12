<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- Dynamic Title --}}
    <title>{{ $title ?? 'HMI Cabang Ponorogo' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo-web.png') }}?v={{ time() }}" />

    {{-- Meta Tags untuk Sharing --}}
    @if(isset($post))
        <meta property="og:title" content="{{ $post->title }}">
        <meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
        <meta property="og:image" content="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/logo-web.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="article">
        <meta property="og:site_name" content="HMI Cabang Ponorogo">

        {{-- Twitter Card --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $post->title }}">
        <meta name="twitter:description" content="{{ Str::limit(strip_tags($post->content), 150) }}">
        <meta name="twitter:image" content="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/logo-web.png') }}">
    @else
        <meta property="og:title" content="HMI Cabang Ponorogo">
        <meta property="og:description" content="Himpunan Mahasiswa Islam (HMI) Cabang Ponorogo adalah salah satu cabang organisasi mahasiswa Islam terbesar di Indonesia, yang berada di wilayah Ponorogo.">
        <meta property="og:image" content="{{ asset('images/logo-web.png') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="HMI Cabang Ponorogo">
    @endif

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
    class="hidden fixed bottom-8 right-8 w-12 h-12 text-white rounded-full shadow-lg transform transition-all duration-300 flex items-center justify-center z-50 group cursor-pointer overflow-hidden"
    style="background: linear-gradient(to right, #16a34a, #0d9488);">
    <svg class="w-6 h-6 transition-transform group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
</button>

    @livewireScripts
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        function initScrollButton() {
            const scrollBtn = document.getElementById('scrollToTop');
            if (!scrollBtn) return;

            window.addEventListener('scroll', () => {
                if (window.scrollY > 300) {
                    scrollBtn.classList.remove('hidden');
                    scrollBtn.classList.add('fade-in');
                } else {
                    scrollBtn.classList.add('hidden');
                }
            });

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
            initScrollButton();
        });

        document.addEventListener('livewire:navigated', () => {
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            AOS.refresh();
            initScrollButton();
        });
    </script>

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

        html {
            scrollbar-width: thin;
            scrollbar-color: #c1c1c1 #f1f1f1;
        }
    </style>
</body>

</html>
