<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-[20%] right-[-5%] w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center items-start mb-8 sm:mb-10 pb-6 border-b border-slate-200 gap-4 sm:gap-6">
        <div class="w-full sm:w-auto">
            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm mb-3">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                Live Broadcast Active
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Live Matches & Scoreboards</h1>
            <p class="mt-2 text-sm sm:text-base text-slate-500">Real-time scores and status updates across all active sports events.</p>
        </div>
        
        @if(auth()->check() && auth()->user()->hasRole(['PIC', 'Admin']))
            <a href="/creatematch" wire:navigate
                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create Matches
            </a>
        @endif
    </div>

    <!-- Matches Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($matches as $match)
            <div wire:key="match-{{ $match->id }}"
                class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 p-8 hover:shadow-xl hover:border-indigo-200 transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1 relative group">
                
                <div>
                    <div class="flex items-center justify-between mb-6 gap-4">
                        <h2 class="text-xl font-black text-slate-900 group-hover:text-indigo-650 transition-colors truncate">
                            {{ $match->title }}
                        </h2>
                        <a href="{{ route('scores.show', $match->id) }}" wire:navigate
                            class="inline-flex items-center justify-center px-3.5 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-bold rounded-xl border border-indigo-250 border-indigo-200/50 transition-all shadow-sm flex-shrink-0">
                            View Livecast →
                        </a>
                    </div>

                    <div
                        class="flex justify-between items-center bg-slate-50 p-6 rounded-2xl border border-slate-100 mb-6 shadow-inner relative overflow-hidden">
                        @foreach($match->participants as $participant)
                            <div class="text-center flex-1 min-w-0">
                                <p class="text-sm text-slate-500 font-bold truncate px-2 capitalize">{{ $participant->user->name }}</p>
                                <div class="text-5xl font-black text-indigo-600 mt-2 tracking-tight">
                                    {{ $livescore[$participant->id] ?? $participant->score }}
                                </div>
                                @if($match->status === 'finished' && $participant->results)
                                    <div class="mt-2">
                                        @if($participant->results === 'win')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-55 bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wider">Winner</span>
                                        @elseif($participant->results === 'lose')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-55 bg-rose-50 text-rose-700 border border-rose-100 uppercase tracking-wider">Runner-up</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-250 border-slate-200 uppercase tracking-wider">Draw</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            @if(!$loop->last)
                                <div class="text-xs font-black text-slate-350 px-4 select-none">VS</div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-between items-center text-sm mt-auto gap-4">
                    <span
                        class="px-3 py-1.5 rounded-xl text-xs font-bold tracking-wide flex items-center gap-1.5
                        {{ $match->status === 'ongoing' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-slate-100 text-slate-650 border border-slate-205 border-slate-200' }}">
                        @if($match->status === 'ongoing')
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        @endif
                        {{ ucfirst($match->status) }}
                    </span>
                    
                    @if(auth()->check() && (auth()->user()->hasRole('Admin') || \App\Models\PicSport::where('user_id', auth()->id())->where('sport_id', $match->sport_id)->exists()))
                        <a href="{{ $match->status === 'ongoing' ? route('scores.manage', $match->id) : '#' }}"
                            @if($match->status === 'ongoing') wire:navigate @endif
                            class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold rounded-xl transition-all
                            {{ $match->status === 'ongoing' ? 'text-indigo-700 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200/50' : 'text-slate-400 bg-slate-100 cursor-not-allowed pointer-events-none border border-slate-200' }}">
                            Manage Scores
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div
                class="col-span-full text-center py-20 bg-white/80 backdrop-blur rounded-3xl border border-dashed border-slate-300 shadow-sm">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                <h3 class="text-xl font-bold text-slate-900 mb-1">No Active Matches</h3>
                <p class="text-slate-500 max-w-sm mx-auto">Check back later for active sports events and live scoreboards.</p>
            </div>
        @endforelse
    </div>
</div>