<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'HMI Cabang Ponorogo')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-web.png') }}?v={{ time() }}" />

    <meta property="og:title" content="{{ $post->title ?? 'Default Title' }}">
    <meta property="og:description"
        content="{{ Str::limit(strip_tags($post->content ?? 'Default Description'), 150) }}">
    <meta property="og:image"
        content="{{ isset($post->thumbnail) ? asset('storage/' . $post->thumbnail) : asset('images/default-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles
</head>

<body class="min-h-screen bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100">

    <x-user.header />

    <main class="flex-1 p-6">
        {{ $slot }}
    </main>

    <x-user.footer />

    @livewireScripts

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                offset: 100,
                once: true
            });
        });
    </script>
</body>
</html>
