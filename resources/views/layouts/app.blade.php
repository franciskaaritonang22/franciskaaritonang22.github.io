<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .grid-bg {
                background-color: #ffffff;
                background-image: 
                    linear-gradient(to right, rgba(0,0,0,0.15) 1px, transparent 1px),
                    linear-gradient(to bottom, rgba(0,0,0,0.15) 1px, transparent 1px);
                background-size: 80px 80px;
                background-position: top left;
            }

            /* ── RESPONSIVE LAYOUT WRAPPER ── */
            .app-layout {
                display: flex;
                min-height: 100vh;
            }
            .app-main {
                flex: 1;
                min-width: 0;
            }

            @media (max-width: 768px) {
                .app-main {
                    padding-top: 56px;
                    padding-bottom: 0;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased text-black min-h-screen">
        <div class="min-h-screen grid-bg app-layout">
            @include('layouts.navigation')

            <div class="app-main">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
