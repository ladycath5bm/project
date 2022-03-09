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

                <div class="flex px-6 py-4">
                    <div class="min-h-screen px-4 py-4 rounded bg-gray-100 ">
                        
                        <div class="flex flex-wrap justify-center bg-white rounded-lg shadow-lg mb-4">
                            <button class="font-bold flex-grow text-gray-900 rounded-lg shadow-lg bg-white text-lg h-12">Ecom</button>            
                        </div>
                        <nav class="flex flex-col bg-white w-48 max-h-screen tex-gray-900 rounded-lg shadow-lg">
                        
                            <div class="mt-2 mb-2 mr-2  max-h-screen">
                                <ul class="ml-2">
                                    @yield('sidebar')
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="flex-grow">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            
        </div>

        @stack('modals')

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>