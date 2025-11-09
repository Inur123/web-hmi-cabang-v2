<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen flex">
 <livewire:components.flash-message />
    {{-- Sidebar --}}
    @includeWhen(Auth::check(), 'livewire.admin.layouts.sidebar')

    <div class="flex-1 flex flex-col">
        {{-- Header --}}
        @includeWhen(Auth::check(), 'livewire.admin.layouts.header')

        {{-- Konten --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        @includeWhen(Auth::check(), 'livewire.admin.layouts.footer')
    </div>

    @livewireScripts
</body>
</html>
