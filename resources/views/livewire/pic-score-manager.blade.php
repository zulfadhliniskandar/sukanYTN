<div class="max-w-xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">

    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div
            class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob">
        </div>
        <div
            class="absolute bottom-[10%] right-[10%] w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob animation-delay-2000">
        </div>
    </div>

    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('listMatch') }}" wire:navigate
            class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-650 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Match List
        </a>
    </div>

    <!-- Manager Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <!-- Header Banner -->
        <div class="relative px-8 py-6 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <h2 class="text-2xl font-black text-white tracking-tight">Manage Match</h2>
            <p class="mt-1.5 text-indigo-100 text-sm font-bold">{{ $match->title }}</p>
            @if ($match->status === 'scheduled')
                <span><button wire:click="updateStatus('ongoing')"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-bold rounded-xl transition-all text-indigo-700 bg-indigo-50 hover:bg-indigo-100 border border-indigo-200/50">Start
                        Match</button></span>
            @endif
        </div>

        <div class="p-8 space-y-6">
            <div class="space-y-4">
                @foreach($match->participants as $participant)
                    <div
                        class="flex items-center justify-between p-5 bg-slate-50/70 rounded-2xl border border-slate-100 transition-all hover:shadow-sm">
                        <span
                            class="font-bold text-slate-800 truncate pr-4 capitalize">{{ $participant->user->name }}</span>
                        <div class="flex items-center gap-3">
                            <button {{ $match->status !== 'ongoing' ? 'disabled' : '' }}
                                wire:click="decrementScore({{ $participant->id }})"
                                class="w-9 h-9 flex items-center justify-center bg-white border border-slate-200 text-slate-600 rounded-full hover:bg-slate-50 hover:text-indigo-600 transition-all shadow-sm disabled:opacity-50 disabled:cursor-not-allowed text-lg font-black">-</button>

                            <span
                                class="w-12 text-center font-black text-2xl text-indigo-650 text-indigo-600">{{ $participant->score }}</span>

                            <button {{ $match->status !== 'ongoing' ? 'disabled' : '' }}
                                wire:click="incrementScore({{ $participant->id }})"
                                class="w-9 h-9 flex items-center justify-center bg-gradient-to-r from-indigo-650 to-indigo-600 bg-indigo-600 text-white rounded-full hover:from-indigo-700 hover:to-indigo-700 transition-all shadow-md shadow-indigo-100 disabled:opacity-50 disabled:cursor-not-allowed text-lg font-black">+</button>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($match->status === 'ongoing')
                <div class="pt-6 border-t border-slate-100">
                    <button wire:confirm="Are you sure you want to end this match?" wire:click="updateStatus('finished')"
                        class="w-full inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-rose-600 to-red-600 px-4 py-3 text-sm font-bold text-white shadow-md shadow-rose-200 hover:from-rose-700 hover:to-red-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                        <svg class="w-4.5 h-4.5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        End Match & Finalize scores
                    </button>
                </div>
            @else
                <div class="pt-6 border-t border-slate-100 text-center bg-slate-50 rounded-2xl py-4">
                    <p class="text-sm font-bold text-slate-500">This match is completed and cannot be edited.</p>
                </div>
            @endif
        </div>
    </div>
</div>