<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@if (isset($title)){{ $title." | " }}@endif{{ config('app.name', '') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=nunito:400,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/guest/default.scss', 'resources/js/app.js'])
    </head>

    <body class="text-gray-900 antialiased">
        
        <div class="site-container">
            <main class="site-main">
                <div class="flex min-h-screen items-center justify-center bg-gray-200">
                    <div class="m-2 w-full max-w-lg sm:w-[480px] bg-white rounded border border-gray-100 drop-shadow-xl">

                        @isset($header)

                            <h2 class="blank-header">{{ $header }}</h2>
                            
                        @endisset

                        <div class="blank-content">
                            {{ $slot }}
                        </div>

                    </div>
                </div>
            </main>
        </div>

    </body>
</html>
