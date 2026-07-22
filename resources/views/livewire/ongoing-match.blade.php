<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-xl font-black text-slate-900 flex items-center">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 mr-2.5 animate-pulse"></span>
            Ongoing Matches
        </h3>
        <a href="{{ route('listMatch') }}" wire:navigate class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">
            View All Matches →
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($ongoingMatches as $match)
            @php
                $isUserInMatch = auth()->check() && $match->participants->contains('user_id', auth()->id());
            @endphp
            <div wire:key="ongoing-match-{{ $match->id }}"
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
                            class="inline-flex items-center justify-center px-3.5 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-bold rounded-xl border border-indigo-200/50 transition-all shadow-xs flex-shrink-0">
                            View Livecast →
                        </a>
                    </div>

                    <div class="flex justify-between items-center bg-slate-50 p-6 rounded-2xl border border-slate-100 mb-6 shadow-inner relative overflow-hidden">
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
                            </div>
                            @if(!$loop->last)
                                <div class="text-xs font-black text-slate-350 px-4 select-none">VS</div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-between items-center text-sm mt-auto gap-4">
                    <span class="px-3 py-1.5 rounded-xl text-xs font-bold tracking-wide flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Ongoing
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
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white/80 backdrop-blur rounded-3xl border border-dashed border-slate-300 shadow-xs">
                <svg class="w-10 h-10 text-slate-300 mx-auto mb-3 text-center inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-6.75a1.125 1.125 0 00-1.125 1.125v3.375m9 0h-9"/>
                </svg>
                <h4 class="text-base font-bold text-slate-800">No Ongoing Matches</h4>
                <p class="text-slate-500 text-xs mt-1">There are no matches currently in progress.</p>
            </div>
        @endforelse
    </div>
</div>