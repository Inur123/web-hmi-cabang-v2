<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Dashboard - Hmi Cabang Ponorogo' }}</title>

    <!-- Favicon - Pindah ke Atas -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-laci-3.png') }}?v={{ time() }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-laci-3.png') }}?v={{ time() }}" />

    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: window.innerWidth >= 1024 }" x-cloak>
    <livewire:components.flash-message />
    {{-- Sidebar --}}
    <x-admin.sidebar />
    <x-admin.mobile-sidebar />

   <div :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="transition-all duration-300">
        {{-- Header --}}
        <x-admin.header />

        {{-- Konten --}}
        <main class="pt-20 md:pt-24 p-4 md:p-6 pb-20 md:pb-24">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <x-admin.footer />
    </div>

    @livewireScripts
</body>

</html>
