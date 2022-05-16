<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

            <div class="min-h-screen bg-gray-100">
                <div>
                    <x-navigation>
                    </x-navigation>
                </div>
                
                <div class="py-16">
                    @yield('sidebar')
                    <div class="flex-grow px-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            
        </div>

        @stack('modals')

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
    <footer class="py-5 bg-gray-50 text-center text-xs text-gray-700">
        <span>Developed by LadyCath</span>
        <br>
        <span>Copyright (c) 2022</span>
    </footer>
</html>