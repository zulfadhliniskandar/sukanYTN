<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            @impersonating
            <span
                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700 border border-rose-200 shadow-sm animate-pulse">
                <span class="w-2 h-2 rounded-full bg-rose-500 mr-2"></span>
                Impersonation Mode Active
            </span>
            @endImpersonating
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Welcome Card -->
            <div
                class="bg-white/90 backdrop-blur-xl overflow-hidden shadow-lg shadow-slate-200/40 sm:rounded-3xl border border-slate-100 relative">
                <div
                    class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-gradient-to-br from-indigo-100 to-violet-100 rounded-full blur-3xl opacity-50">
                </div>
                <div class="p-8 relative z-10 flex flex-col sm:flex-row items-center text-center sm:text-left">
                    <div
                        class="h-16 w-16 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-500 sm:mr-6 mb-4 sm:mb-0 shadow-sm flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Welcome back, {{ auth()->user()->name }}!</h3>
                        <p class="text-slate-500 mt-1">You're successfully logged into the system.</p>
                    </div>
                </div>
            </div>

            @canImpersonate
            @if(isset($users) && count($users) > 0)
                <!-- Admin Impersonation Feature -->
                <div
                    class="bg-white/90 backdrop-blur-xl overflow-hidden shadow-lg shadow-slate-200/40 sm:rounded-3xl border border-slate-100">
                    <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 flex items-center">
                                <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                User Impersonation
                            </h3>
                            <p class="text-sm text-slate-500 mt-1">Select a user below to temporarily log in as them.</p>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($users as $user)
                                <a href="{{ route('impersonate', $user->id) }}"
                                    class="group flex items-center p-4 bg-white border border-slate-200 rounded-2xl hover:border-indigo-300 hover:shadow-md transition-all duration-200 transform hover:-translate-y-1">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-indigo-100 to-violet-100 flex items-center justify-center text-indigo-700 font-bold text-sm shadow-inner mr-4 group-hover:from-indigo-500 group-hover:to-violet-500 group-hover:text-white transition-colors">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p
                                            class="text-sm font-bold text-slate-900 truncate group-hover:text-indigo-600 transition-colors">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-xs text-slate-500 truncate mt-0.5">
                                            {{ $user->email }}
                                        </p>
                                        <p class="text-xs text-slate-500 truncate mt-0.5">
                                            {{ $user->role }}
                                        </p>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 opacity-0 group-hover:opacity-100 group-hover:text-indigo-500 transition-all transform -translate-x-2 group-hover:translate-x-0 ml-2"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
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