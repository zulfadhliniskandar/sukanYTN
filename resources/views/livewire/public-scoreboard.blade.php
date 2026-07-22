<div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob"></div>
        <div class="absolute bottom-[10%] right-[10%] w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('listMatch') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-650 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Match List
        </a>
    </div>

    <!-- Scoreboard Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <!-- Header Banner -->
        <div class="relative px-8 py-6 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 overflow-hidden flex justify-between items-center">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-white/20 text-white border border-white/10 uppercase tracking-wider mb-2">Live Broadcast</span>
                <h2 class="text-2xl font-black text-white tracking-tight">{{ $match->title }}</h2>
            </div>
            
            <div class="flex-shrink-0">
                <span class="px-3 py-1.5 rounded-xl text-xs font-bold tracking-wide flex items-center gap-1.5 bg-white/20 text-white border border-white/10">
                    @if($match->status === 'ongoing')
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    @endif
                    {{ ucfirst($match->status) }}
                </span>
            </div>
        </div>

        <div class="p-8 space-y-6">
            <!-- Scoreboard Grid -->
            <div class="flex justify-between items-center bg-slate-50/80 p-8 rounded-2xl border border-slate-100 shadow-inner relative overflow-hidden">
                @foreach($match->participants as $participant)
                    <div class="text-center flex-1 min-w-0">
                        <p class="text-base font-bold text-slate-700 truncate px-2 capitalize">{{ $participant->user->name }}</p>
                        <div class="text-6xl font-black text-indigo-600 mt-3 tracking-tight">
                            {{ $livescore[$participant->id] ?? $participant->score }}
                        </div>
                        @if($match->status === 'finished' && $participant->results)
                            <div class="mt-2">
                                @if($participant->results === 'win')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wider">Winner</span>
                                @elseif($participant->results === 'lose')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100 uppercase tracking-wider">Runner-up</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200 uppercase tracking-wider">Draw</span>
                                @endif
                            </div>
                        @endif
                    </div>
                    @if(!$loop->last)
                        <div class="text-lg font-black text-slate-300 px-6 select-none">VS</div>
                    @endif
                @endforeach
            </div>

            <!-- Footer Details -->
            <div class="flex items-center justify-between text-xs text-slate-400 font-semibold pt-4 border-t border-slate-100">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4.5 h-4.5 text-slate-350" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Updated: {{ now()->format('H:i:s') }}</span>
                </div>
                <div class="text-indigo-600 hover:underline cursor-pointer select-none">
                    Auto-refreshing Live
                </div>
            </div>
        </div>
    </div>
</div>