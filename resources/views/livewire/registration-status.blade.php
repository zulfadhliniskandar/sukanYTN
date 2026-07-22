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
                <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                My Registrations
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Registration Status</h1>
            <p class="mt-2 text-sm sm:text-base text-slate-500">Track the approval status of your sport registrations.</p>
        </div>
        <div>
            <a href="{{ route('registerSport') }}" wire:navigate class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Registration
            </a>
        </div>
    </div>

    @if ($registrations->isEmpty())
        <!-- Empty State -->
        <div class="text-center py-20 bg-white/80 backdrop-blur rounded-3xl border border-dashed border-slate-300 shadow-sm">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 text-slate-400 mb-6 border border-slate-200">
                <svg class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">No Registrations Found</h3>
            <p class="text-slate-500 max-w-md mx-auto">You haven't registered for any sports yet. Click the button above to get started.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($registrations as $registration)
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl hover:border-indigo-200 transition-all duration-300 transform hover:-translate-y-1 relative">
                    <!-- Status Badge -->
                    <div class="absolute top-5 right-5 z-10">
                        @if($registration->status === 'approved')
                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20 shadow-sm border border-emerald-100">
                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Approved
                            </span>
                        @elseif($registration->status === 'rejected')
                            <span class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-3 py-1.5 text-xs font-bold text-rose-700 ring-1 ring-inset ring-rose-600/20 shadow-sm border border-rose-100">
                                <svg class="w-3.5 h-3.5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                Rejected
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/20 shadow-sm border border-amber-100">
                                <svg class="w-3.5 h-3.5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Pending
                            </span>
                        @endif
                    </div>

                    <!-- Card Header Background -->
                    <div class="h-20 bg-gradient-to-r from-indigo-50/50 to-white border-b border-slate-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-100/50 rounded-full blur-xl group-hover:bg-indigo-200/50 transition-colors"></div>
                    </div>

                    <!-- Card Content -->
                    <div class="p-6 -mt-10 relative flex-1 flex flex-col justify-between">
                        <div>
                            <!-- Sport Icon Box -->
                            <div class="h-16 w-16 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center text-indigo-650 mb-4 bg-gradient-to-br from-white to-indigo-50/50 group-hover:scale-105 transition-transform">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>

                            <div class="mb-5">
                                <h3 class="text-xl font-black text-slate-900 leading-tight mb-1 truncate">{{ $registration->sport->name }}</h3>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">{{ $registration->sport->type }} Sport</span>
                                </div>
                            </div>

                            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 mb-5 group-hover:bg-indigo-50/40 transition-colors">
                                @if($registration->sport->type === 'team')
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Team / Group Name</p>
                                    <p class="text-sm font-bold text-slate-800">{{ $registration->groupName ?? 'N/A' }}</p>
                                @else
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Participant</p>
                                    <p class="text-sm font-bold text-slate-800">{{ $user->name ?? 'Individual' }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-1.5 text-xs text-slate-400 font-semibold mt-auto pt-2 border-t border-slate-100">
                            <svg class="w-4 h-4 text-slate-350" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Submitted on {{ $registration->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>