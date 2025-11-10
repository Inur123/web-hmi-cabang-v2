<!DOCTYPE html>
<html lang="en" data-hs-theme="default">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Authentication' }}</title>
        <!-- Favicon - Pindah ke Atas -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-web.png') }}?v={{ time() }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-web.png') }}?v={{ time() }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>
<body class="bg-gradient-to-br from-teal-100 via-teal-200 to-teal-50 min-h-screen flex items-center justify-center">
    <livewire:components.flash-message />
    <div class="flex w-full min-h-screen items-center justify-center">
        <div class="relative w-full max-w-md bg-white/90 backdrop-blur-xl border-teal-200 rounded-2xl shadow-2xl p-8">
            {{ $slot }}
        </div>
    </div>
    @livewireScripts
</body>
</html>
