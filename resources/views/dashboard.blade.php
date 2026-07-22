<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl sm:text-3xl text-slate-900 tracking-tight leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">Sukan YTN Sports Management Portal</p>
            </div>

            @impersonating
            <div
                class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-extrabold bg-rose-100 text-rose-700 border border-rose-200 shadow-xs animate-pulse">
                <span class="w-2.5 h-2.5 rounded-full bg-rose-500 mr-2"></span>
                Impersonation Mode Active
            </div>
            @endImpersonating
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="max-w-7xl mx-auto space-y-8">

            <!-- Welcome Header Card -->
            <div
                class="bg-white/90 backdrop-blur-xl overflow-hidden shadow-lg shadow-slate-200/40 rounded-3xl border border-slate-100 relative">
                <div
                    class="absolute top-0 right-0 -mt-10 -mr-10 w-48 h-48 bg-gradient-to-br from-indigo-100 via-violet-100 to-purple-100 rounded-full blur-3xl opacity-60 pointer-events-none">
                </div>
                <div class="p-6 sm:p-8 relative z-10 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="flex flex-col sm:flex-row items-center text-center sm:text-left gap-5">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-white flex items-center justify-center font-black text-2xl shadow-lg shadow-indigo-200 shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="flex items-center justify-center sm:justify-start gap-2.5 mb-1 flex-wrap">
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900">Welcome back,
                                    {{ auth()->user()->name }}!</h3>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-extrabold bg-indigo-50 text-indigo-700 border border-indigo-100 uppercase tracking-wider">
                                    {{ auth()->user()->role ?? auth()->user()->roles->pluck('name')->first() ?? 'User' }}
                                </span>
                            </div>
                            <p class="text-slate-500 text-sm font-medium">Here is what is happening in your sports
                                management console today.</p>
                        </div>
                    </div>

                    <!-- Quick Navigation Badges -->
                    <div class="flex items-center gap-3 shrink-0 flex-wrap justify-center">
                        <a href="{{ route('listMatch') }}" wire:navigate
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200/80 text-slate-700 text-xs font-bold rounded-xl transition-all flex items-center gap-2 shadow-2xs">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Matches
                        </a>
                        <a href="{{ route('listSport') }}" wire:navigate
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200/80 text-slate-700 text-xs font-bold rounded-xl transition-all flex items-center gap-2 shadow-2xs">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Sports
                        </a>
                        <a href="{{ route('listVenue') }}" wire:navigate
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200/80 text-slate-700 text-xs font-bold rounded-xl transition-all flex items-center gap-2 shadow-2xs">
                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Venues
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pending Registrations Banner Section for Admin / PIC -->
            @if (auth()->check() && auth()->user()->hasRole(['Admin', 'PIC']))
                @php
                    $pendingCount = \App\Models\Registration::where('status', 'pending')->count();
                @endphp

                @if($pendingCount > 0)
                    <div
                        class="relative overflow-hidden bg-gradient-to-r from-red-500 via-rose-500 to-pink-600 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-rose-200/50 border border-red-400/30">
                        <div
                            class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl pointer-events-none">
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
                                    <div class="flex items-center gap-2 mb-1">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black bg-white/20 backdrop-blur-md text-white border border-white/30 uppercase tracking-wider">
                                            Action Required
                                        </span>
                                        <span class="text-xs font-bold text-white/90 bg-white/10 px-2 py-0.5 rounded-md">
                                            {{ $pendingCount }} Pending {{ Str::plural('Registration', $pendingCount) }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl sm:text-2xl font-black tracking-tight">Pending Registration Approvals
                                    </h3>
                                    <p class="text-white/85 text-sm mt-0.5 font-medium">There are {{ $pendingCount }}
                                        registration {{ Str::plural('application', $pendingCount) }} awaiting administrative
                                        approval.</p>
                                </div>
                            </div>
                            <a href="{{ route('approveRegistration') }}" wire:navigate
                                class="inline-flex items-center px-6 py-3 bg-white text-rose-700 font-extrabold rounded-2xl shadow-lg hover:bg-rose-50 hover:shadow-xl transition-all transform hover:-translate-y-0.5 shrink-0 text-sm">
                                Review & Approve →
                            </a>
                        </div>
                    </div>
                @else
                    <div
                        class="bg-emerald-50/90 border border-emerald-200/80 rounded-3xl p-5 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-emerald-100 text-emerald-600 rounded-2xl shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-base font-bold text-emerald-950">All Registrations Up To Date</h4>
                                <p class="text-xs sm:text-sm text-emerald-700 font-medium">There are currently no pending
                                    registrations requiring review.</p>
                            </div>
                        </div>
                        <a href="{{ route('approveRegistration') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white font-bold text-xs rounded-xl hover:bg-emerald-700 transition-colors shadow-xs shrink-0">
                            View Registration List →
                        </a>
                    </div>
                @endif
            @endif

            @livewire('ongoing-match')

            <!-- Admin Impersonation Feature -->
            @canImpersonate
            @if(isset($users) && count($users) > 0)
                <div x-data="{ search: '' }"
                    class="bg-white/90 backdrop-blur-xl overflow-hidden shadow-lg shadow-slate-200/40 rounded-3xl border border-slate-100">
                    <div
                        class="px-6 sm:px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 flex items-center">
                                <svg class="w-5 h-5 text-indigo-600 mr-2.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                User Impersonation
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 font-medium mt-0.5">Select a user below to switch
                                session context and log in as them.</p>
                        </div>

                        <!-- Search Filter -->
                        <div class="relative w-full sm:w-64">
                            <input x-model="search" type="text" placeholder="Search user name or email..."
                                class="w-full text-xs font-medium rounded-xl border-slate-200 pl-9 pr-4 py-2 focus:border-indigo-500 focus:ring-indigo-500 shadow-xs placeholder-slate-400">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5 pointer-events-none" fill="none"
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
                                    class="group flex items-center p-4 bg-white border border-slate-200/80 rounded-2xl hover:border-indigo-400 hover:shadow-md transition-all duration-200 transform hover:-translate-y-1">
                                    <div
                                        class="flex-shrink-0 h-11 w-11 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-indigo-100 mr-3.5 group-hover:scale-105 transition-transform">
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
                                            class="inline-block mt-1 text-[10px] font-bold px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 group-hover:bg-indigo-50 group-hover:text-indigo-700 transition-colors capitalize">
                                            {{ $user->role ?? $user->roles->pluck('name')->first() ?? 'User' }}
                                        </span>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 opacity-0 group-hover:opacity-100 group-hover:text-indigo-600 transition-all transform -translate-x-2 group-hover:translate-x-0 ml-2 shrink-0"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
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