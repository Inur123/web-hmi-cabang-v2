<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Halaman Utama' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">



    <x-user.header />
    {{-- Konten utama --}}
    <main class="flex-1 p-6">
        {{ $slot }}
    </main>


    <x-user.footer />
    @livewireScripts
</body>

</html>
