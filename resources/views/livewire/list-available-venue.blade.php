<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
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
                Venues
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Available Venues</h1>
            <p class="mt-2 text-sm sm:text-base text-slate-500">View all registered Venues and their designated sports.</p>
        </div>
        @if(auth()->check() && auth()->user()->hasRole('PIC||Admin'))
            <a href="{{ route('addVenue') }}" wire:navigate
                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Venue
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($venues as $venue)
            <div wire:key="venue-{{ $venue->id }}" class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl hover:border-indigo-200 transition-all duration-300 transform hover:-translate-y-1">
                
                <div class="px-6 py-6 border-b border-slate-100 bg-gradient-to-br from-indigo-50/80 to-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-100/50 rounded-full blur-xl group-hover:bg-indigo-200/50 transition-colors"></div>
                    <h2 class="text-2xl font-black text-slate-900 mb-1 truncate">{{ $venue->name }}</h2>
                    
                    @if($venue->description)
                        <p class="text-slate-500 text-sm mt-2 line-clamp-2 leading-relaxed">{{ $venue->description }}</p>
                    @endif
                </div>

                <div class="px-6 py-5 flex-1 bg-white flex flex-col justify-between">
                    <div>
                        <div class="mb-4">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Location Maps</span>
                            <a href="{{ $venue->map_url }}" target="_blank"
                                class="inline-flex items-center text-sm font-semibold text-indigo-650 hover:text-indigo-850 transition-colors group">
                                <span class="bg-indigo-50 p-1.5 rounded-lg mr-2 group-hover:bg-indigo-100 transition-colors">
                                    <svg class="w-4.5 h-4.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </span>
                                View on Google Maps
                            </a>
                        </div>

                        @if($venue->sports->count() > 0)
                            <div class="mt-4 pt-4 border-t border-slate-100">
                                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Hosted Sports</h3>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($venue->sports as $sport)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100/50 capitalize">
                                            {{ $sport->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    @if (auth()->check() && auth()->user()->hasRole('pic||admin'))
                        <div class="mt-6 pt-4 border-t border-slate-100 flex gap-2 justify-end">
                            <a href="{{ route('editVenue', $venue->id) }}" wire:navigate
                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm transition-all" title="Edit">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button type="button" wire:confirm="Are you sure you want to delete this venue?" wire:click="deleteVenue({{$venue->id}})"
                                class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all" title="Delete">
                                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>