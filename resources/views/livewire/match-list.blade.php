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

    <!-- Beautified Filter Buttons Bar -->
    <div class="mb-8 flex items-center justify-between flex-wrap gap-2 bg-slate-100/70 p-1.5 rounded-2xl border border-slate-200/60 shadow-inner max-w-fit">
        <button wire:click="filter('all')"
            class="inline-flex items-center gap-2 px-4 py-2 text-xs font-black rounded-xl transition-all duration-200 cursor-pointer select-none
            {{ $selectedStatus === 'all' ? 'bg-gradient-to-r from-indigo-600 to-violet-600 text-white shadow-md shadow-indigo-200/50 scale-[1.02]' : 'text-slate-600 hover:text-slate-900 hover:bg-white/60' }}">
            <span>All Matches</span>
            <span class="px-1.5 py-0.5 rounded-md text-[10px] font-black {{ $selectedStatus === 'all' ? 'bg-white/20 text-white' : 'bg-slate-200/80 text-slate-700' }}">
                {{ $counts['all'] ?? 0 }}
            </span>
        </button>

        <button wire:click="filter('ongoing')"
            class="inline-flex items-center gap-2 px-4 py-2 text-xs font-black rounded-xl transition-all duration-200 cursor-pointer select-none
            {{ $selectedStatus === 'ongoing' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-200/50 scale-[1.02]' : 'text-slate-600 hover:text-slate-900 hover:bg-white/60' }}">
            <span class="w-2 h-2 rounded-full {{ $selectedStatus === 'ongoing' ? 'bg-white animate-pulse' : 'bg-emerald-500' }}"></span>
            <span>Ongoing</span>
            <span class="px-1.5 py-0.5 rounded-md text-[10px] font-black {{ $selectedStatus === 'ongoing' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800' }}">
                {{ $counts['ongoing'] ?? 0 }}
            </span>
        </button>

        <button wire:click="filter('scheduled')"
            class="inline-flex items-center gap-2 px-4 py-2 text-xs font-black rounded-xl transition-all duration-200 cursor-pointer select-none
            {{ $selectedStatus === 'scheduled' ? 'bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-md shadow-amber-200/50 scale-[1.02]' : 'text-slate-600 hover:text-slate-900 hover:bg-white/60' }}">
            <span class="w-2 h-2 rounded-full {{ $selectedStatus === 'scheduled' ? 'bg-white' : 'bg-amber-500' }}"></span>
            <span>Scheduled</span>
            <span class="px-1.5 py-0.5 rounded-md text-[10px] font-black {{ $selectedStatus === 'scheduled' ? 'bg-white/20 text-white' : 'bg-amber-100 text-amber-800' }}">
                {{ $counts['scheduled'] ?? 0 }}
            </span>
        </button>

        <button wire:click="filter('finished')"
            class="inline-flex items-center gap-2 px-4 py-2 text-xs font-black rounded-xl transition-all duration-200 cursor-pointer select-none
            {{ $selectedStatus === 'finished' ? 'bg-gradient-to-r from-slate-700 to-slate-900 text-white shadow-md shadow-slate-300/50 scale-[1.02]' : 'text-slate-600 hover:text-slate-900 hover:bg-white/60' }}">
            <span>Finished</span>
            <span class="px-1.5 py-0.5 rounded-md text-[10px] font-black {{ $selectedStatus === 'finished' ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-700' }}">
                {{ $counts['finished'] ?? 0 }}
            </span>
        </button>
    </div>

    <!-- Matches Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($matches as $match)
            @php
                $isUserInMatch = auth()->check() && $match->participants->contains('user_id', auth()->id());
            @endphp
            <div wire:key="match-{{ $match->id }}"
                class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-lg shadow-slate-200/40 border p-8 hover:shadow-xl transition-all duration-300 flex flex-col justify-between transform hover:-translate-y-1 relative group {{ $isUserInMatch ? 'border-2 border-indigo-500 ring-2 ring-indigo-500/20 shadow-indigo-100/50' : 'border-slate-100 hover:border-indigo-200' }}">
                
                @if($isUserInMatch)
                    <div class="absolute -top-3.5 right-6 z-10">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-gradient-to-r from-indigo-600 to-violet-600 text-white shadow-md border border-indigo-400/30 tracking-wide uppercase">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            Your Match
                        </span>
                    </div>
                @endif

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

                    @if($match->participants->isEmpty())
                        <div class="bg-amber-50/60 p-6 rounded-2xl border border-amber-100/80 mb-6 text-center">
                            <p class="text-xs font-bold text-amber-800 uppercase tracking-wider mb-1">No Participants Assigned</p>
                            <p class="text-xs text-slate-500 mb-3">Athletes or contingents have not been assigned to this match yet.</p>
                            @if(auth()->check() && auth()->user()->hasRole(['Admin', 'PIC']))
                                <a href="{{ route('assignMatchParticipants', ['title' => $match->title]) }}" wire:navigate
                                    class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold rounded-xl text-white bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 shadow-md shadow-amber-200/50 transition-all">
                                    Assign Participants →
                                </a>
                            @endif
                        </div>
                    @else
                        <div
                            class="flex justify-between items-center bg-slate-50 p-6 rounded-2xl border border-slate-100 mb-6 shadow-inner relative overflow-hidden">
                            @foreach($match->participants as $participant)
                                <div class="text-center flex-1 min-w-0">
                                    <p class="text-sm font-bold truncate px-2 capitalize {{ auth()->check() && $participant->user_id === auth()->id() ? 'text-indigo-700 font-extrabold' : 'text-slate-500' }}">
                                        {{ $participant->user->name ?? 'Participant' }}
                                        @if(auth()->check() && $participant->user_id === auth()->id())
                                            <span class="text-[10px] bg-indigo-100 text-indigo-700 font-extrabold px-1.5 py-0.5 rounded ml-1 lowercase">(you)</span>
                                        @endif
                                    </p>
                                    <div class="text-5xl font-black text-indigo-600 mt-2 tracking-tight">
                                        {{ $livescore[$participant->id] ?? $participant->score }}
                                    </div>
                                    @if($match->status === 'finished' && $participant->results)
                                        <div class="mt-2">
                                            @if($participant->results === 'win')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wider">Winner</span>
                                            @elseif($participant->results === 'lose')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-100 uppercase tracking-wider">Runner-up</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200 uppercase tracking-wider">Draw</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                @if(!$loop->last)
                                    <div class="text-xs font-black text-slate-350 px-4 select-none">VS</div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-between items-center text-sm mt-auto gap-4">
                    <span
                        class="px-3 py-1.5 rounded-xl text-xs font-bold tracking-wide flex items-center gap-1.5
                        {{ $match->status === 'ongoing' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : ($match->status === 'scheduled' ? 'bg-amber-50 text-amber-700 border border-amber-100' : 'bg-slate-100 text-slate-650 border border-slate-200') }}">
                        @if($match->status === 'ongoing')
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        @elseif($match->status === 'scheduled')
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        @endif
                        {{ ucfirst($match->status) }}
                    </span>
                    
                    @if(auth()->check() && (auth()->user()->hasRole('Admin') || \App\Models\PicSport::where('user_id', auth()->id())->where('sport_id', $match->sport_id)->exists()))
                        @php
                            $canManage = in_array(strtolower($match->status), ['ongoing', 'scheduled']);
                        @endphp
                        <a href="{{ $canManage ? route('scores.manage', $match->id) : '#' }}"
                            @if($canManage) wire:navigate @endif
                            class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold rounded-xl transition-all
                            {{ $canManage ? 'text-indigo-700 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200/50' : 'text-slate-400 bg-slate-100 cursor-not-allowed pointer-events-none border border-slate-200' }}">
                            Manage Scores
                        </a>
                    @endif
                </div>
                @if (auth()->check() && auth()->user()->hasRole('pic||admin'))
                        <div class="mt-6 pt-4 border-t border-slate-100 flex gap-2 justify-end">
                            <a href="{{ route('editMatch', $match->id) }}" wire:navigate
                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm transition-all" title="Edit">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button type="button" wire:confirm="Are you sure you want to delete this match?" wire:click="deleteMatch('{{ $match->id }}')"
                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all" title="Delete">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    @endif
            </div>
            
        @empty
            <div
                class="col-span-full text-center py-20 bg-white/80 backdrop-blur rounded-3xl border border-dashed border-slate-300 shadow-sm">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                <h3 class="text-xl font-bold text-slate-900 mb-1">No Matches Found</h3>
                <p class="text-slate-500 max-w-sm mx-auto">There are no matches matching the selected status filter.</p>
            </div>
        @endforelse
    </div>
</div>