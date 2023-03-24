<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            @if (isset($title))
                        {{ $title." | " }}
            @endif
            {{ config('app.name', 'Laravel') }}
        </title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles()
    </head>
    <body class="font-sans antialiased">

            <div class="app-grid">

                @include('tenant.backend.includes.sidebar')

                <div id="appContainer" class="app-container">

                    @include('tenant.backend.includes.action-nav')

                    <main class="app-main">
                        <!-- Page Heading -->
                        @if (isset($header))
                            <header class="app-header">
                                 <h2 class="app-title">
                                    {{ $header }}
                                    @if (isset($header_button))
                                        <span class="ml-2">{{ $header_button }}</span>
                                    @endif  
                                </h2>
                            </header>
                        @endif
                        {{ $slot }}
                    </main>

                </div>
            </div>

            @include('tenant.backend.includes.footer')
        @livewireScripts()    
    </body>
</html>
