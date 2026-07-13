<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if(auth()->check() && auth()->user()->hasRole(['PIC', 'Admin']))
        <div>
            <a href="/creatematch" wire:navigate
                class="text-white bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">Create
                Matches</a>
        </div>
    @endif
    <div class="mb-10 flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-gray-200 pb-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-10">Live Matches & Scoreboards</h1>
            <p class="mt-2 text-sm text-slate-500">Real-time scores and status updates across all active sports events
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <span
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-blue-50 text-blue-700 border border-blue-200 shadow-sm">
                <span class="w-2.5 h-2.5 rounded-full bg-blue-600 animate-ping"></span>
                Live Broadcast Active
            </span>
        </div>
    </div>

    <!-- Matches Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @forelse($matches as $match)
            <div
                class="bg-white rounded-2xl shadow-xl shadow-slate-100 border border-slate-100 p-8 hover:shadow-2xl hover:border-blue-100 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                            {{ $match->title }}
                        </h2>
                        <a href="{{ route('scores.show', $match->id) }}" wire:navigate
                            class="text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 hover:bg-blue-100 transition-colors">
                            View Livecast →
                        </a>
                    </div>

                    <div
                        class="flex justify-between items-center bg-slate-50/70 p-6 rounded-2xl border border-slate-100 mb-6 shadow-inner">
                        @foreach($match->participants as $participant)
                            <div class="text-center flex-1">
                                <p class="text-sm text-slate-500 font-semibold truncate px-2">{{ $participant->user->name }}</p>
                                <div class="text-5xl font-black text-blue-600 mt-2 tracking-tight">
                                    {{ $livescore[$participant->id] ?? $participant->score }}
                                </div>
                            </div>
                            @if(!$loop->last)
                                <div class="text-lg font-black text-slate-300 px-4">VS</div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex justify-between items-center text-sm">
                    <span
                        class="px-3.5 py-1.5 rounded-full text-xs font-bold tracking-wide flex items-center gap-1.5
                                                                                                                {{ $match->status === 'ongoing' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                        @if($match->status === 'ongoing')
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        @endif
                        {{ ucfirst($match->status) }}
                    </span>
                    @if(auth()->check() && auth()->user()->hasRole(['PIC', 'Admin']))
                        <a href="{{ $match->status === 'ongoing' ? route('scores.manage', $match->id) : '#' }}"
                            @if($match->status === 'ongoing') wire:navigate @endif
                            class="text-xs font-bold {{ $match->status === 'ongoing' ? 'text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100' : 'text-gray-400 bg-gray-100 cursor-not-allowed pointer-events-none'}}">
                            Manage Scores
                        </a>
                    @endif

                </div>
            </div>
        @empty
            <div
                class="col-span-full text-center py-20 bg-white rounded-2xl border border-dashed border-slate-200 shadow-sm">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                <h3 class="text-lg font-bold text-slate-800">No Matches Available</h3>
                <p class="text-sm text-slate-500 mt-1">Check back later for active sports events and live scoreboards.</p>
            </div>
        @endforelse
    </div>
</div>