<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-[20%] right-[-5%] w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center items-start mb-8 sm:mb-10 pb-6 border-b border-slate-200 gap-4 sm:gap-6">
        <div class="w-full sm:w-auto">
            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm mb-3">
                <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                Sport PICs
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">PICs for {{ $sport->name }}</h1>
            <p class="mt-2 text-sm sm:text-base text-slate-500">Manage the Persons In Charge assigned to this sport.</p>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <a href="{{ route('listSport') }}" wire:navigate
                class="flex-1 sm:flex-initial inline-flex items-center justify-center px-5 py-3 bg-white text-slate-700 border border-slate-200 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-all">
                Back
            </a>
            <a href="{{ route('assignPIC', $sport) }}" wire:navigate
                class="flex-1 sm:flex-initial inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5 whitespace-nowrap">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Assign PIC
            </a>
        </div>
    </div>

    <!-- PICs Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @forelse ($pics as $pic)
            <div wire:key="pic-{{ $pic->id }}"
                class="bg-white/90 backdrop-blur-xl p-6 rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 hover:shadow-xl hover:border-indigo-200 transition-all duration-300 transform hover:-translate-y-1 relative group flex items-start gap-4">
                
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-100 to-indigo-50 text-indigo-700 rounded-2xl flex items-center justify-center flex-shrink-0 font-black text-lg border border-indigo-100 shadow-inner group-hover:scale-105 transition-transform">
                    {{ substr($pic->user->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <h2 class="text-xl font-bold text-slate-900 truncate group-hover:text-indigo-650 transition-colors">
                        {{ $pic->user->name }}</h2>
                    <p class="text-xs text-slate-500 mt-1 flex items-center gap-1.5 break-all font-semibold">
                        <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ $pic->user->email }}
                    </p>
                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100/50 uppercase tracking-wider">
                            PIC Role
                        </span>
                        <button type="button" wire:confirm="Are you sure you want to remove this PIC?" wire:click="deletePIC({{ $pic->id }})"
                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all opacity-0 group-hover:opacity-100 focus:opacity-100" title="Delete">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20 bg-white/80 backdrop-blur rounded-3xl border border-dashed border-slate-300 shadow-sm">
                <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <h3 class="text-xl font-bold text-slate-900 mb-1">No PICs assigned</h3>
                <p class="text-slate-500 max-w-sm mx-auto">Get started by assigning a Person In Charge to manage matches and scores.</p>
                <div class="mt-6">
                    <a href="{{ route('assignPIC', $sport) }}" wire:navigate
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                        Assign PIC
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>