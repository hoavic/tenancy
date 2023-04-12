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
        @vite(['resources/css/client/style.scss', 'resources/js/app.js'])
    </head>
    <body class="antialiased">

        <div x-data="{showSidebar: false}" 

            :class="{'showSidebar' : showSidebar, '': !showSidebar}" 
            class="app-grid">
            
                @include('client.includes.sidebar')

                <div id="appContainer" class="app-container">

                    @include('client.includes.nav')

                    <main class="app-main">
                        <!-- Page Heading -->
                        @if (isset($header))
                            <header class="flex">                       
                                    {{ $header }}
                            </header>
                        @endif
                        {{ $slot }}
                    </main>

                    @include('client.includes.footer')
                </div>
            </div>

    </body>
</html>
