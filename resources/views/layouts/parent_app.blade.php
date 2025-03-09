<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('csms_logo.webp') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href = "https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Bonbon&family=Bungee+Shade&family=Bungee+Spice&family=Coda:wght@400;800&family=Codystar:wght@300;400&family=Ewert&family=Faster+One&family=Honk&family=Irish+Grover&family=Kablammo&family=Nabla&family=Pirata+One&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Rubik+Moonrocks&family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.parent_navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                <div class="container">
                  @yield('content')
                </div>
            </main>
            @include('layouts.footer')
        </div>
    </body>
</html>
