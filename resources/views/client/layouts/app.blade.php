<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
            <div class="app-top-nav">
                @include('includes.nav')
            </div>
            <div class="app-grid">

                @include('client.includes.sidebar')

                <div class="app-container">

                    

                    <main class="app-main">
                        <!-- Page Heading -->
                        @if (isset($header))
                            <header class="">                       
                                    {{ $header }}
                            </header>
                        @endif
                        {{ $slot }}
                    </main>

                    @include('includes.footer')
                </div>
            </div>

    </body>
</html>
