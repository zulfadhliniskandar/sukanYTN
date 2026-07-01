<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sukan YTN') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-slate-50 text-slate-800 selection:bg-blue-600 selection:text-white">
    <!-- Navbar -->
    <nav class="absolute top-0 w-full z-50 py-6 px-6 lg:px-12 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-600/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <span class="text-2xl font-black tracking-tight text-slate-900">Sukan YTN</span>
        </div>

        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-full transition-all shadow-md shadow-blue-600/20 hover:shadow-lg hover:shadow-blue-600/40 transform hover:-translate-y-0.5">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-blue-400/20 rounded-full blur-3xl opacity-50 mix-blend-multiply"></div>
            <div class="absolute top-40 -left-20 w-[500px] h-[500px] bg-indigo-400/20 rounded-full blur-3xl opacity-50 mix-blend-multiply animate-pulse"></div>
            <div class="absolute bottom-0 right-1/4 w-[800px] h-[400px] bg-emerald-400/10 rounded-full blur-3xl opacity-50 mix-blend-multiply"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur-sm border border-slate-200 shadow-sm mb-8 animate-fade-in-up">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-bold tracking-wide text-slate-600 uppercase">Live Tournament Updates</span>
            </div>

            <h1 class="text-5xl lg:text-7xl font-black tracking-tight text-slate-900 mb-6 drop-shadow-sm">
                Experience the Thrill of <br class="hidden lg:block"/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Sukan YTN</span>
            </h1>
            
            <p class="mt-4 text-lg lg:text-xl text-slate-600 max-w-2xl mx-auto font-medium mb-10">
                The ultimate platform for real-time sports updates. Follow your favorite teams, track live scores, and never miss a moment of the action.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#live-scores" class="px-8 py-4 rounded-full bg-slate-900 text-white font-bold tracking-wide hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/20 hover:shadow-xl hover:shadow-slate-900/30 transform hover:-translate-y-1 flex items-center gap-2">
                    View Live Scores
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L11.586 11H3a1 1 0 110-2h8.586l-2.293-2.293a1 1 0 011.414-1.414l4 4z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#about" class="px-8 py-4 rounded-full bg-white text-slate-700 font-bold tracking-wide border border-slate-200 hover:border-slate-300 hover:bg-slate-50 transition-all">
                    Learn More
                </a>
            </div>
        </div>
    </div>

    <!-- Live Scores Section -->
    <div id="live-scores" class="relative z-20 max-w-7xl mx-auto -mt-10 sm:-mt-20">
        <livewire:match-list />
    </div>

    <!-- Features Section -->
    <div id="about" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl">Everything you need</h2>
                <p class="mt-4 text-lg text-slate-600">All the tools to keep you connected to the tournament.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Real-Time Updates</h3>
                    <p class="text-slate-600">Get instant score changes synchronized directly from the officials to your device without refreshing.</p>
                </div>
                
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Comprehensive Standings</h3>
                    <p class="text-slate-600">Track team performances, brackets, and overall tournament progress in one unified view.</p>
                </div>

                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Multi-Venue Support</h3>
                    <p class="text-slate-600">Navigate between different sports and locations effortlessly with our intuitive filtering.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 py-12 text-center text-slate-400">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col items-center justify-center">
            <div class="flex items-center gap-2 mb-6 opacity-50 grayscale">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                <span class="text-xl font-black tracking-tight">Sukan YTN</span>
            </div>
            <p class="text-sm mb-2">&copy; {{ date('Y') }} Sukan YTN. All rights reserved.</p>
            <p class="text-xs text-slate-500">
                Powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }}
            </p>
        </div>
    </footer>
</body>
</html>