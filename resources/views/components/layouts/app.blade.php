<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme({ default: 'light' })">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.31.0/dist/tabler-icons.min.css" />

    {{-- for jodit wysiwyg --}}
    <link rel="stylesheet" href="//unpkg.com/jodit@4.1.16/es2021/jodit.min.css">
    <script src="//unpkg.com/jodit@4.1.16/es2021/jodit.min.js"></script>


    <tallstackui:script />
    @livewireStyles
    @stack('style')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body class="font-poppins" x-bind:class="{ 'dark bg-main': darkTheme, 'bg-gray-50': !darkTheme }">
    <x-ts-dialog />
    <x-ts-toast />
    <x-ts-layout>
        <x-slot:header>
            <livewire:partials.panel.headers.header-index />
        </x-slot:header>
        <x-slot:menu>
            <livewire:partials.panel.sidebar.sidebar-index />
        </x-slot:menu>
        <main class="pt-10">
            {{ $slot }}
        </main>
    </x-ts-layout>
    @livewireScripts
    @filepondScripts
    @stack('scripts')
</body>

</html>