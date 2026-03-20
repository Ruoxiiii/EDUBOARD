<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js'])
        @include('partials.appearance-script')
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-200 transition-colors duration-300">
        <div class="admin-layout {{ ($appearance['navPos'] ?? 'left') === 'top' ? 'nav-top' : (($appearance['navPos'] ?? 'left') === 'right' ? 'nav-right' : 'nav-left') }} w-full min-h-screen">
            @include('layouts.sidebar')

            <div class="admin-main w-full flex flex-col">
                @include('layouts.top-navbar')

                <main class="p-6 flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
