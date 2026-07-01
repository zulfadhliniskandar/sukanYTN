<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sukan YTN') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased selection:bg-blue-600 selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-950 relative overflow-hidden">
            <!-- Decorative Ambient Blobs -->
            <div class="absolute top-10 left-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
            <div class="absolute bottom-10 right-1/4 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl pointer-events-none animate-pulse" style="animation-delay: 2s;"></div>

            <!-- Logo / Branding Area -->
            <div class="relative z-10 mb-6 text-center">
                <a href="/" wire:navigate class="inline-flex flex-col items-center gap-2 group">
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-xl rounded-2xl flex items-center justify-center border border-white/20 shadow-xl group-hover:scale-105 group-hover:border-blue-400 transition-all duration-300">
                        <svg class="w-10 h-10 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-white tracking-wider font-['Outfit']">SUKAN <span class="text-blue-400">YTN</span></span>
                </a>
            </div>

            <!-- Form Container Card -->
            <div class="relative z-10 w-full sm:max-w-md px-8 py-10 bg-white/95 backdrop-blur-xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] border border-white/20 overflow-hidden sm:rounded-3xl transition-all duration-300">
                {{ $slot }}
            </div>

            <!-- Footer Note -->
            <div class="relative z-10 mt-8 text-sm text-white/50 tracking-wide">
                © {{ date('Y') }} Sukan YTN. All rights reserved.
            </div>
        </div>
    </body>
</html>
