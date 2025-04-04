<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400..700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles        

        <script>
            if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
                document.querySelector('html').classList.remove('dark');
                document.querySelector('html').style.colorScheme = 'light';
            } else {
                document.querySelector('html').classList.add('dark');
                document.querySelector('html').style.colorScheme = 'dark';
            }
        </script>
    </head>
    <body class="font-inter antialiased bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400">

        <main class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('/images/loandes.svg');">

            <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg w-full max-w-sm">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    <a href="{{ route('dashboard') }}">
                        <img class="h-20" src="/images/fcc.png" alt="Logo">
                    </a>
                </div>
                <!-- Form Slot -->
                <div>
                    {{ $slot }}
                </div>
            </div>

        </main>
        @livewireScripts
    </body>
</html>
