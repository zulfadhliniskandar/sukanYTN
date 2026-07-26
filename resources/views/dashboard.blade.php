<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl sm:text-3xl text-slate-900 tracking-tight leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">Sukan YTN Sports Management Console</p>
            </div>

            @impersonating
            <div
                class="inline-flex items-center px-4 py-2 rounded-full text-xs font-extrabold bg-rose-50 text-rose-700 border border-rose-200/80 shadow-xs animate-pulse">
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500 mr-2"></span>
                Impersonation Mode Active
            </div>
            @endImpersonating
        </div>
    </x-slot>

    <div class="py-8 sm:py-10 relative">
        <!-- Background Ambient Accents -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
            <div
                class="absolute top-[-5%] left-[40%] w-96 h-96 bg-indigo-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
            </div>
            <div
                class="absolute top-[30%] right-[-5%] w-96 h-96 bg-violet-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
            </div>
        </div>

        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Welcome Header Card -->
            <div
                class="bg-white/90 backdrop-blur-xl overflow-hidden shadow-xl shadow-slate-200/40 rounded-3xl border border-slate-100/80 relative">
                <div
                    class="absolute top-0 right-0 -mt-10 -mr-10 w-56 h-56 bg-gradient-to-br from-indigo-500/10 via-violet-500/10 to-purple-500/10 rounded-full blur-3xl opacity-70 pointer-events-none">
                </div>

                <div class="p-6 sm:p-8 relative z-10 flex flex-col lg:flex-row items-center justify-between gap-6">
                    <div class="flex flex-col sm:flex-row items-center text-center sm:text-left gap-5">
                        <div
                            class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-700 text-white flex items-center justify-center font-black text-2xl sm:text-3xl shadow-lg shadow-indigo-200/60 shrink-0 transform hover:scale-105 transition-transform duration-300">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            @php
                                $userRole = auth()->user()->role ?? auth()->user()->roles->pluck('name')->first() ?? 'User';
                                $assignedSports = '';
                                if (auth()->user()->hasRole('PIC')) {
                                    $assignedSports = \App\Models\PicSport::where('user_id', auth()->id())
                                        ->with('sport')
                                        ->get()
                                        ->pluck('sport.name')
                                        ->filter()
                                        ->join(', ');
                                }
                            @endphp
                            <div class="flex items-center justify-center sm:justify-start gap-2.5 mb-1.5 flex-wrap">
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                    Welcome back, {{ auth()->user()->name }}!
                                </h3>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-2xs uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-1.5"></span>
                                    {{ $userRole }}
                                </span>
                                @if(auth()->user()->hasRole('PIC'))
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-emerald-50 text-emerald-700 border border-emerald-100 shadow-2xs">
                                        <svg class="w-3.5 h-3.5 mr-1 text-emerald-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        Sport: {{ $assignedSports ?: 'Unassigned' }}
                                    </span>
                                @endif
                            </div>
                            <p class="text-slate-500 text-sm font-medium max-w-xl">
                                Real-time stats, match updates, and management tools across all sports events.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Navigation Action Buttons -->
                    <div
                        class="flex items-center gap-3 shrink-0 flex-wrap justify-center w-full lg:w-auto pt-4 lg:pt-0 border-t lg:border-t-0 border-slate-100">
                        <a href="{{ route('listMatch') }}" wire:navigate
                            class="px-4 py-2.5 bg-slate-50 hover:bg-indigo-50 text-slate-700 hover:text-indigo-700 text-xs font-bold rounded-2xl border border-slate-200/70 hover:border-indigo-200/70 transition-all duration-200 flex items-center gap-2 shadow-2xs group">
                            <div
                                class="p-1 rounded-lg bg-white group-hover:bg-indigo-100 text-slate-500 group-hover:text-indigo-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            Matches
                        </a>
                        <a href="{{ route('listSport') }}" wire:navigate
                            class="px-4 py-2.5 bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 text-xs font-bold rounded-2xl border border-slate-200/70 hover:border-emerald-200/70 transition-all duration-200 flex items-center gap-2 shadow-2xs group">
                            <div
                                class="p-1 rounded-lg bg-white group-hover:bg-emerald-100 text-slate-500 group-hover:text-emerald-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            Sports
                        </a>
                        <a href="{{ route('listVenue') }}" wire:navigate
                            class="px-4 py-2.5 bg-slate-50 hover:bg-purple-50 text-slate-700 hover:text-purple-700 text-xs font-bold rounded-2xl border border-slate-200/70 hover:border-purple-200/70 transition-all duration-200 flex items-center gap-2 shadow-2xs group">
                            <div
                                class="p-1 rounded-lg bg-white group-hover:bg-purple-100 text-slate-500 group-hover:text-purple-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            Venues
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Metrics Grid -->
            @php
                $totalSportsCount = \App\Models\Sport::count();
                $totalVenuesCount = \App\Models\Venue::count();
                $totalMatchesCount = \App\Models\MatchRecord::count();
                $approvedAthletesCount = \App\Models\Registration::where('status', 'approved')->count();
            @endphp
            @if(auth()->user()->hasRole(['Admin', 'PIC']))
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                    <a href="{{ route('listSport') }}" wire:navigate
                        class="bg-white/80 backdrop-blur-xl p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-md shadow-slate-200/30 hover:border-emerald-300 hover:shadow-lg transition-all group">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Sports</span>
                            <div
                                class="p-2.5 bg-emerald-50 text-emerald-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $totalSportsCount }}</p>
                    </a>

                    <a href="{{ route('listVenue') }}" wire:navigate
                        class="bg-white/80 backdrop-blur-xl p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-md shadow-slate-200/30 hover:border-purple-300 hover:shadow-lg transition-all group">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Venues</span>
                            <div
                                class="p-2.5 bg-purple-50 text-purple-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $totalVenuesCount }}</p>
                    </a>

                    <a href="{{ route('listMatch') }}" wire:navigate
                        class="bg-white/80 backdrop-blur-xl p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-md shadow-slate-200/30 hover:border-indigo-300 hover:shadow-lg transition-all group">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Matches</span>
                            <div
                                class="p-2.5 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $totalMatchesCount }}
                        </p>
                    </a>

                    <div
                        class="bg-white/80 backdrop-blur-xl p-5 sm:p-6 rounded-3xl border border-slate-100 shadow-md shadow-slate-200/30">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Approved Athletes</span>
                            <div class="p-2.5 bg-rose-50 text-rose-600 rounded-2xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                            {{ $approvedAthletesCount }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Action Required Banners Section for Admin / PIC -->
            @if (auth()->check() && auth()->user()->hasRole(['Admin', 'PIC']))
                @php
                    if (auth()->user()->hasRole('Admin')) {
                        $pendingCount = \App\Models\Registration::where('status', 'pending')->count();
                        $matchWithoutParticipants = \App\Models\MatchRecord::doesntHave('participants')->count();
                        $registrationsWithoutContingent = \App\Models\Registration::where('status', 'approved')->whereNull('contingent_id')->count();
                    } else {
                        $picSportIds = \App\Models\PicSport::where('user_id', auth()->id())->pluck('sport_id');
                        $pendingCount = \App\Models\Registration::where('status', 'pending')->whereIn('sport_id', $picSportIds)->count();
                        $matchWithoutParticipants = \App\Models\MatchRecord::doesntHave('participants')->whereIn('sport_id', $picSportIds)->count();
                        $registrationsWithoutContingent = 0;
                    }
                @endphp

                <!-- Pending Registration Approvals Banner -->
                @if($pendingCount > 0)
                    <div
                        class="relative overflow-hidden bg-gradient-to-r from-red-500 via-rose-500 to-pink-600 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-rose-200/40 border border-red-400/30">
                        <div
                            class="absolute -right-10 -bottom-10 w-56 h-56 bg-white/10 rounded-full blur-2xl pointer-events-none">
                        </div>
                        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                            <div class="flex items-center gap-5">
                                <div
                                    class="p-3.5 bg-white/20 backdrop-blur-md rounded-2xl border border-white/20 shadow-inner shrink-0 relative">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-white"></span>
                                    </span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black bg-white/20 backdrop-blur-md text-white border border-white/30 uppercase tracking-wider">
                                            Action Required
                                        </span>
                                        <span
                                            class="text-xs font-extrabold text-white bg-white/15 px-2.5 py-0.5 rounded-full border border-white/20">
                                            {{ $pendingCount }} Pending {{ Str::plural('Registration', $pendingCount) }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl sm:text-2xl font-black tracking-tight">
                                        Pending Registration Approvals
                                    </h3>
                                    <p class="text-white/90 text-sm mt-0.5 font-medium">
                                        @if(auth()->user()->hasRole('PIC'))
                                            There {{ $pendingCount === 1 ? 'is' : 'are' }} {{ $pendingCount }} pending athlete
                                            {{ Str::plural('application', $pendingCount) }} awaiting your PIC review.
                                        @else
                                            There {{ $pendingCount === 1 ? 'is' : 'are' }} {{ $pendingCount }} registration
                                            {{ Str::plural('application', $pendingCount) }} awaiting administrative approval.
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('approveRegistration') }}" wire:navigate
                                class="inline-flex items-center px-6 py-3.5 bg-white text-rose-700 font-extrabold rounded-2xl shadow-lg hover:bg-rose-50 hover:shadow-xl transition-all transform hover:-translate-y-0.5 shrink-0 text-sm cursor-pointer">
                                Review & Approve →
                            </a>
                        </div>
                    </div>
                @else
                    <div
                        class="bg-emerald-50/90 backdrop-blur-xl border border-emerald-200/80 rounded-3xl p-5 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="p-3.5 bg-emerald-100 text-emerald-600 rounded-2xl shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-base font-black text-emerald-950">All Registrations Up To Date</h4>
                                <p class="text-xs sm:text-sm text-emerald-700 font-medium">
                                    @if(auth()->user()->hasRole('PIC'))
                                        There are no pending registrations requiring review for your assigned sports.
                                    @else
                                        There are currently no pending athlete registrations requiring administrative review.
                                    @endif
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('approveRegistration') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl transition-all shadow-xs shrink-0">
                            View Registration List →
                        </a>
                    </div>
                @endif

                <!-- Matches Without Participants Banner -->
                @if($matchWithoutParticipants > 0)
                    <div
                        class="relative overflow-hidden bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-amber-200/40 border border-amber-400/30">
                        <div
                            class="absolute -right-10 -bottom-10 w-56 h-56 bg-white/10 rounded-full blur-2xl pointer-events-none">
                        </div>
                        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                            <div class="flex items-center gap-5">
                                <div
                                    class="p-3.5 bg-white/20 backdrop-blur-md rounded-2xl border border-white/20 shadow-inner shrink-0 relative">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-white"></span>
                                    </span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black bg-white/20 backdrop-blur-md text-white border border-white/30 uppercase tracking-wider">
                                            Action Required
                                        </span>
                                        <span
                                            class="text-xs font-extrabold text-white bg-white/15 px-2.5 py-0.5 rounded-full border border-white/20">
                                            {{ $matchWithoutParticipants }} Unassigned
                                            {{ Str::plural('Match', $matchWithoutParticipants) }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl sm:text-2xl font-black tracking-tight">
                                        Match(es) Without Participants
                                    </h3>
                                    <p class="text-white/90 text-sm mt-0.5 font-medium">
                                        @if(auth()->user()->hasRole('PIC'))
                                            There {{ $matchWithoutParticipants === 1 ? 'is' : 'are' }}
                                            {{ $matchWithoutParticipants }} scheduled
                                            {{ Str::plural('match', $matchWithoutParticipants) }} requiring participant assignment
                                            for your sports.
                                        @else
                                            There {{ $matchWithoutParticipants === 1 ? 'is' : 'are' }}
                                            {{ $matchWithoutParticipants }} scheduled
                                            {{ Str::plural('match', $matchWithoutParticipants) }} requiring participant assignment.
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('listMatch', ['status' => 'no_participant']) }}" wire:navigate
                                class="inline-flex items-center px-6 py-3.5 bg-white text-amber-800 font-extrabold rounded-2xl shadow-lg hover:bg-amber-50 hover:shadow-xl transition-all transform hover:-translate-y-0.5 shrink-0 text-sm cursor-pointer">
                                Review & Assign →
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Unassigned Registrations Banner (Admin only) -->
                @if (auth()->user()->hasRole('Admin') && $registrationsWithoutContingent > 0)
                    <div
                        class="relative overflow-hidden bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-purple-200/40 border border-purple-400/30">
                        <div
                            class="absolute -right-10 -bottom-10 w-56 h-56 bg-white/10 rounded-full blur-2xl pointer-events-none">
                        </div>
                        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                            <div class="flex items-center gap-5">
                                <div
                                    class="p-3.5 bg-white/20 backdrop-blur-md rounded-2xl border border-white/20 shadow-inner shrink-0 relative">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-white"></span>
                                    </span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black bg-white/20 backdrop-blur-md text-white border border-white/30 uppercase tracking-wider">
                                            Action Required
                                        </span>
                                        <span
                                            class="text-xs font-extrabold text-white bg-white/15 px-2.5 py-0.5 rounded-full border border-white/20">
                                            {{ $registrationsWithoutContingent }} Unassigned
                                            {{ Str::plural('Registration', $registrationsWithoutContingent) }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl sm:text-2xl font-black tracking-tight">
                                        Unassigned Registrations
                                    </h3>
                                    <p class="text-white/90 text-sm mt-0.5 font-medium">
                                        There {{ $registrationsWithoutContingent === 1 ? 'is' : 'are' }}
                                        {{ $registrationsWithoutContingent }} approved registration(s) without a contingent
                                        assigned.
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('listApprovedRegistrations', ['type' => 'no_contingent']) }}" wire:navigate
                                class="inline-flex items-center px-6 py-3.5 bg-white text-purple-800 font-extrabold rounded-2xl shadow-lg hover:bg-purple-50 hover:shadow-xl transition-all transform hover:-translate-y-0.5 shrink-0 text-sm cursor-pointer">
                                Review Registrations →
                            </a>
                        </div>
                    </div>
                @endif
            @endif

            <!-- Live Ongoing Match Broadcast Component -->
            @livewire('ongoing-match')

            <!-- Admin Impersonation Feature -->
            @canImpersonate
            @if(isset($users) && count($users) > 0)
                <div x-data="{ search: '' }"
                    class="bg-white/90 backdrop-blur-xl overflow-hidden shadow-xl shadow-slate-200/40 rounded-3xl border border-slate-100">
                    <div
                        class="px-6 sm:px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 flex items-center tracking-tight">
                                <div class="p-2 bg-indigo-50 rounded-xl text-indigo-600 mr-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                User Impersonation Console
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-1">Select a user below to switch
                                session context and test as them.</p>
                        </div>

                        <!-- Search Filter -->
                        <div class="relative w-full sm:w-72">
                            <input x-model="search" type="text" placeholder="Search by name, email or role..."
                                class="w-full text-xs font-medium rounded-2xl border-slate-200/80 bg-white pl-10 pr-4 py-3 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 shadow-xs placeholder-slate-400 transition-all">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5 pointer-events-none" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="p-6 sm:p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($users as $user)
                                <a href="{{ route('impersonate', $user->id) }}"
                                    x-show="!search || '{{ strtolower(addslashes($user->name)) }}'.includes(search.toLowerCase()) || '{{ strtolower(addslashes($user->email)) }}'.includes(search.toLowerCase())"
                                    class="group flex items-center p-4 bg-white border border-slate-200/80 rounded-2xl hover:border-indigo-400 hover:shadow-lg hover:shadow-indigo-100/50 transition-all duration-200 transform hover:-translate-y-1">
                                    <div
                                        class="flex-shrink-0 h-11 w-11 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white font-black text-sm shadow-md shadow-indigo-100 mr-3.5 group-hover:scale-105 transition-transform">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="text-sm font-bold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-xs text-slate-500 truncate mt-0.5 font-medium">
                                            {{ $user->email }}
                                        </p>
                                        <span
                                            class="inline-block mt-1 text-[10px] font-black px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 group-hover:bg-indigo-50 group-hover:text-indigo-700 transition-colors capitalize">
                                            {{ $user->role ?? $user->roles->pluck('name')->first() ?? 'User' }}
                                        </span>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 opacity-0 group-hover:opacity-100 group-hover:text-indigo-600 transition-all transform -translate-x-2 group-hover:translate-x-0 ml-2 shrink-0"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l7-7m-7 7H3" />
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            @endCanImpersonate

        </div>
    </div>
</x-app-layout>