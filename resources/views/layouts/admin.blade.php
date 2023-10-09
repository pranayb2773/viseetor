<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{
      darkMode: localStorage.getItem('darkMode')
      || localStorage.setItem('darkMode', 'system')}"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
    x-bind:class="{'dark': darkMode === 'dark' || (darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)}"
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="bg-secondary-100 text-secondary-900 overflow-y-auto min-h-screen dark:text-secondary-100 dark:bg-secondary-900">
        <div x-data="{ open: false }" @keydown.window.escape="open = false">
            <livewire:layout.admin-navigation></livewire:layout.admin-navigation>

            <div class="lg:pl-72">
                <main class="py-6 bg-secondary-100 overflow-y-auto dark:bg-secondary-900" style="height: calc(100vh - 4rem);">
                    <div class="mx-auto max-w-full">
                        <div>
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    </body>
</html>
