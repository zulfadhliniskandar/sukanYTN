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
                Pending Approvals
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Approve Registrations</h1>
            <p class="mt-2 text-sm sm:text-base text-slate-500">Review and manage pending sport registrations below.</p>
        </div>
        @if(auth()->check() && auth()->user()->hasRole('Admin'))
            <a href="{{ route('listApprovedRegistrations') }}" wire:navigate
                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                View Approved
            </a>
        @endif
    </div>
    
    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-8 rounded-2xl bg-emerald-50 p-4 border border-emerald-100 flex items-center shadow-sm">
            <div class="flex-shrink-0 bg-emerald-100 rounded-full p-2 mr-4 text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
        </div>
    @endif

    @if($registrations->isEmpty())
        <!-- Empty State -->
        <div class="text-center py-20 bg-white/80 backdrop-blur rounded-3xl border border-dashed border-slate-300 shadow-sm">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 text-slate-400 mb-6 border border-slate-200">
                <svg class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">No pending registrations</h3>
            <p class="text-slate-500 max-w-md mx-auto">All caught up! There are no registrations waiting for approval right now.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($registrations as $reg)
                @if($reg->sport && $reg->sport->type == 'team')
                    <div wire:key="reg-{{ $reg->id }}" class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl hover:border-indigo-200 transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Card Header -->
                        <div class="px-6 py-6 border-b border-slate-100 bg-gradient-to-br from-indigo-50/80 to-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-100/50 rounded-full blur-xl group-hover:bg-indigo-200/50 transition-colors"></div>
                            <div class="relative flex justify-between items-start mb-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-100 text-indigo-700 uppercase tracking-wide border border-indigo-200/50">
                                    {{ $reg->sport->name }}
                                </span>
                                <span class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                            </div>
                            <h3 class="text-2xl font-black text-slate-900 mb-1 truncate">{{ $reg->groupName }}</h3>
                        </div>

                        <!-- Card Body -->
                        <div class="px-6 py-5 flex-1 bg-white">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Team Roster ({{ is_array($reg->name) ? count($reg->name) : 0 }} Members)</h4>
                            <ul class="space-y-3">
                                @if(is_array($reg->name) || is_object($reg->name))
                                    @foreach ($reg->name as $member)
                                        <li class="flex items-center text-sm font-semibold text-slate-700 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                            <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-100 to-violet-100 text-indigo-700 flex items-center justify-center text-xs font-bold mr-3 border border-indigo-200 shadow-inner flex-shrink-0">
                                                {{ substr($member, 0, 1) }}
                                            </div>
                                            <span class="truncate">{{ $member }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-sm text-slate-500 italic bg-slate-50 p-3 rounded-lg border border-dashed border-slate-200">No members listed</li>
                                @endif
                            </ul>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex gap-3 mt-auto">
                            <button wire:click="updateStatus('approved', {{ $reg->id }})" wire:loading.attr="disabled"
                                class="flex-1 inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-3 py-2.5 text-sm font-bold text-white shadow-md shadow-emerald-250 hover:from-emerald-700 hover:to-teal-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Approve
                            </button>
                            <button wire:click="updateStatus('rejected', {{ $reg->id }})" wire:loading.attr="disabled"
                                class="flex-1 inline-flex justify-center items-center rounded-xl bg-white px-3 py-2.5 text-sm font-bold text-rose-600 shadow-sm ring-1 ring-inset ring-rose-200 hover:bg-rose-50 transition-colors">
                                <svg class="-ml-1 mr-2 h-4 w-4 text-rose-450" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reject
                            </button>
                        </div>
                    </div>
                @else
                    <div wire:key="reg-{{ $reg->id }}" class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl hover:border-emerald-200 transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Card Header -->
                        <div class="px-6 py-6 border-b border-slate-100 bg-gradient-to-br from-emerald-50/80 to-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-emerald-100/50 rounded-full blur-xl group-hover:bg-emerald-200/50 transition-colors"></div>
                            <div class="relative flex justify-between items-start mb-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wide border border-emerald-200/50">
                                    {{ $reg->sport->name ?? 'Unknown Sport' }}
                                </span>
                                <span class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                            </div>
                            <h3 class="text-2xl font-black text-slate-900 mb-1 truncate">Individual Athlete</h3>
                        </div>

                        <!-- Card Body -->
                        <div class="px-6 py-5 flex-1 bg-white">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Athlete Details</h4>
                            <div class="flex items-center bg-slate-50 p-3 rounded-xl border border-slate-100">
                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-lg font-bold shadow-sm flex-shrink-0">
                                    {{ substr($reg->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div class="ml-4 overflow-hidden">
                                    <h3 class="text-base font-bold text-slate-900 truncate">{{ $reg->user->name ?? 'Unknown User' }}</h3>
                                    <p class="text-xs text-slate-500 truncate">{{ $reg->user->email ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex gap-3 mt-auto">
                            <button wire:click="updateStatus('approved', {{ $reg->id }})" wire:loading.attr="disabled"
                                class="flex-1 inline-flex justify-center items-center rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-3 py-2.5 text-sm font-bold text-white shadow-md shadow-emerald-250 hover:from-emerald-700 hover:to-teal-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Approve
                            </button>
                            <button wire:click="updateStatus('rejected', {{ $reg->id }})" wire:loading.attr="disabled"
                                class="flex-1 inline-flex justify-center items-center rounded-xl bg-white px-3 py-2.5 text-sm font-bold text-rose-600 shadow-sm ring-1 ring-inset ring-rose-200 hover:bg-rose-50 transition-colors">
                                <svg class="-ml-1 mr-2 h-4 w-4 text-rose-450" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reject
                            </button>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>