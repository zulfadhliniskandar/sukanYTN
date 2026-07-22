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
                <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2"></span>
                Contingents
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Available Contingents</h1>
            <p class="mt-2 text-sm sm:text-base text-slate-500">View and manage all registered Contingents for the tournaments.</p>
        </div>
        
        @if(auth()->check() && (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('admin')))
            <a href="{{ route('addContingent') }}" wire:navigate
                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Contingent
            </a>
        @endif
    </div>

    @if($contingents->isEmpty())
        <!-- Empty State -->
        <div class="text-center py-20 bg-white/80 backdrop-blur-sm rounded-3xl border border-dashed border-slate-300 shadow-sm">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 text-slate-400 mb-6 border border-slate-200">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">No Contingents Found</h3>
            <p class="text-slate-500 max-w-md mx-auto">There are currently no contingents registered in the system.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($contingents as $contingent)
                <div wire:key="contingent-{{ $contingent->id }}" class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl hover:border-indigo-200 transition-all duration-300 transform hover:-translate-y-1 relative">
                    
                    <a href="{{ route('detailsEachContingent', $contingent->id) }}" wire:navigate class="absolute inset-0 z-10"></a>

                    <div class="px-6 py-8 border-b border-slate-100 bg-gradient-to-br from-indigo-50/80 to-white relative overflow-hidden flex-1 flex flex-col items-center justify-center text-center">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-100/50 rounded-full blur-xl group-hover:bg-indigo-200/50 transition-colors"></div>
                        
                        <div class="relative z-20">
                            <div class="h-20 w-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white text-3xl font-black shadow-md shadow-indigo-200 mb-5 transform group-hover:scale-105 transition-transform">
                                {{ strtoupper(substr($contingent->name, 0, 1)) }}
                            </div>
                            <h2 class="text-2xl font-black text-slate-900 mb-1 line-clamp-2 px-2">{{ $contingent->name }}</h2>
                        </div>
                    </div>

                    @if (auth()->check() && (auth()->user()->hasRole('Admin') || auth()->user()->hasRole('admin')))
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-center gap-3 relative z-20">
                            <a href="{{ route('detailsEachContingent', $contingent->id) }}" wire:navigate class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm transition-all focus:ring-2 focus:ring-indigo-500" title="View Details">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <a href="{{ route('editContingent', $contingent->id) }}" wire:navigate class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm transition-all focus:ring-2 focus:ring-indigo-500" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button type="button" onclick="if(!confirm('Are you sure you want to delete this contingent?')) { event.stopImmediatePropagation(); return false; }" wire:click="deleteContingent({{ $contingent->id }})" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all focus:ring-2 focus:ring-rose-500" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>