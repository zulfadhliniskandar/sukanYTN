<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    
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

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-10 pb-6 border-b border-slate-200 gap-6">
        <div>
            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm mb-3">
                <span class="w-2 h-2 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                Approved
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">Approved Registrations</h1>
            <p class="mt-2 text-base text-slate-500">Manage and oversee all finalized participants and teams.</p>
        </div>
        
        @if(auth()->check() && auth()->user()->hasRole('Admin'))
            <a href="{{ route('approveRegistration') }}" wire:navigate
                class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Pending Approvals
            </a>
        @endif
    </div>

    @if($approvedRegistrations->isEmpty())
        <!-- Empty State -->
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-300 shadow-sm">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 text-slate-400 mb-6 border border-slate-200">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">No Approved Registrations</h3>
            <p class="text-slate-500 max-w-md mx-auto">There are currently no approved registrations in the system. Check the pending approvals page.</p>
        </div>
    @else
        <!-- Registrations Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach ($approvedRegistrations as $registration)
                @if($registration->sport && $registration->sport->type == 'team')
                    <!-- Team Card -->
                    <div wire:key="registration-{{ $registration->id }}" class="bg-white rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl hover:border-indigo-200 transition-all duration-300 transform hover:-translate-y-1">
                        
                        <!-- Card Header -->
                        <div class="px-6 py-6 border-b border-slate-100 bg-gradient-to-br from-indigo-50/80 to-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-100/50 rounded-full blur-xl group-hover:bg-indigo-200/50 transition-colors"></div>
                            
                            <div class="relative flex justify-between items-start mb-4">
                                <div class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-100 text-indigo-700 uppercase tracking-wide border border-indigo-200/50">
                                    {{ $registration->sport->name }}
                                </div>
                                
                                <div class="flex items-center gap-1.5">
                                    <button type="button" onclick="if(!confirm('Are you sure you want to mark this registration as pending?')) { event.stopImmediatePropagation(); return false; }" wire:click="changeStatus({{ $registration->id }}, 'pending')" class="px-2.5 py-1 text-[10px] font-bold rounded bg-amber-50 text-amber-600 border border-amber-200 hover:bg-amber-100 transition-colors shadow-sm" title="Mark as Pending">Set Pending</button>
                                    <button type="button" onclick="if(!confirm('Are you sure you want to mark this registration as rejected?')) { event.stopImmediatePropagation(); return false; }" wire:click="changeStatus({{ $registration->id }}, 'rejected')" class="px-2.5 py-1 text-[10px] font-bold rounded bg-rose-50 text-rose-600 border border-rose-200 hover:bg-rose-100 transition-colors shadow-sm" title="Mark as Rejected">Set Rejected</button>
                                </div>
                            </div>

                            <h3 class="text-2xl font-black text-slate-900 mb-1 truncate">{{ $registration->groupName }}</h3>
                            
                            <div class="flex items-center text-sm font-medium text-slate-500 mt-2 gap-4">
                                <span class="flex items-center">
                                    <svg class="mr-1.5 h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ is_array($registration->name) ? count($registration->name) : 0 }} Members
                                </span>
                                
                                @if(!$registration->contingent)
                                    <a href="{{ route('addToContingent', $registration) }}" wire:navigate class="flex items-center text-rose-500 hover:text-rose-700 hover:underline">
                                        <svg class="mr-1 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        No Contingent
                                    </a>
                                @else
                                    <span class="flex items-center text-indigo-700 bg-white/60 backdrop-blur px-2 py-0.5 rounded-full text-xs font-semibold border border-indigo-200">
                                        {{ $registration->contingent->name }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Body (Roster) -->
                        <div class="px-6 py-5 flex-1 bg-white">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Team Roster</h4>
                            <ul class="space-y-3">
                                @if(is_array($registration->name) || is_object($registration->name))
                                    @foreach(array_slice((array)$registration->name, 0, 3) as $member)
                                        <li class="flex items-center text-sm font-semibold text-slate-700 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                            <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-100 to-violet-100 text-indigo-700 flex items-center justify-center text-xs font-bold mr-3 border border-indigo-200 shadow-inner flex-shrink-0">
                                                {{ substr($member, 0, 1) }}
                                            </div>
                                            <span class="truncate">{{ $member }}</span>
                                        </li>
                                    @endforeach
                                    @if(count((array)$registration->name) > 3)
                                        <li class="text-xs font-bold text-indigo-500 uppercase tracking-wider px-2 pt-2">
                                            + {{ count((array)$registration->name) - 3 }} more member(s)
                                        </li>
                                    @endif
                                @else
                                    <li class="text-sm text-slate-500 italic bg-slate-50 p-3 rounded-lg border border-dashed border-slate-200">No members listed.</li>
                                @endif
                            </ul>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-2">
                            <a href="{{ route('viewRegistration', $registration) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm transition-all focus:ring-2 focus:ring-indigo-500" title="View Details">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <a href="{{ route('editRegistration', $registration) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm transition-all focus:ring-2 focus:ring-indigo-500" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button type="button" onclick="if(!confirm('Are you sure you want to delete this registration?')) { event.stopImmediatePropagation(); return false; }" wire:click="deleteRegistration({{ $registration->id }})" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all focus:ring-2 focus:ring-rose-500" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>

                    </div>
                @else
                    <!-- Individual Card -->
                    <div wire:key="registration-{{ $registration->id }}" class="bg-white rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 flex flex-col group hover:shadow-xl hover:border-emerald-200 transition-all duration-300 transform hover:-translate-y-1">
                        
                        <div class="px-6 py-6 border-b border-slate-100 relative overflow-hidden">
                            <div class="flex justify-between items-start mb-6 relative z-10">
                                <div class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 uppercase tracking-wide border border-emerald-200/50">
                                    {{ $registration->sport->name ?? 'Unknown Sport' }}
                                </div>
                                
                                <div class="flex items-center gap-1.5">
                                    <button type="button" onclick="if(!confirm('Are you sure you want to mark this registration as pending?')) { event.stopImmediatePropagation(); return false; }" wire:click="changeStatus({{ $registration->id }}, 'pending')" class="px-2.5 py-1 text-[10px] font-bold rounded bg-amber-50 text-amber-600 border border-amber-200 hover:bg-amber-100 transition-colors shadow-sm" title="Mark as Pending">Set Pending</button>
                                    <button type="button" onclick="if(!confirm('Are you sure you want to mark this registration as rejected?')) { event.stopImmediatePropagation(); return false; }" wire:click="changeStatus({{ $registration->id }}, 'rejected')" class="px-2.5 py-1 text-[10px] font-bold rounded bg-rose-50 text-rose-600 border border-rose-200 hover:bg-rose-100 transition-colors shadow-sm" title="Mark as Rejected">Set Rejected</button>
                                </div>
                            </div>

                            <div class="flex items-center flex-1 py-2 relative z-10">
                                <div class="h-20 w-20 rounded-full bg-gradient-to-br from-emerald-400 to-teal-600 flex items-center justify-center text-white text-3xl font-black shadow-md shadow-emerald-200 flex-shrink-0 border-4 border-white ring-1 ring-slate-100 group-hover:scale-105 transition-transform">
                                    {{ substr($registration->user->name ?? 'U', 0, 1) }}
                                </div>
                                
                                <div class="ml-5">
                                    <h3 class="text-2xl font-bold text-slate-900 mb-1">{{ $registration->user->name ?? 'Unknown' }}</h3>
                                    <p class="text-sm font-medium text-slate-500 mb-2">Individual Athlete</p>
                                    
                                    @if(!$registration->contingent)
                                        <a href="{{ route('addToContingent', $registration) }}" wire:navigate class="inline-flex items-center text-xs font-semibold text-rose-500 hover:text-rose-700 bg-rose-50 px-2.5 py-1 rounded-md border border-rose-100 transition-colors shadow-sm">
                                            <svg class="mr-1.5 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            Add Contingent
                                        </a>
                                    @else
                                        <span class="inline-flex items-center text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full text-xs font-semibold border border-emerald-200 shadow-sm">
                                            <svg class="mr-1.5 h-3.5 w-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                                            {{ $registration->contingent->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-slate-50 mt-auto flex items-center justify-end gap-2 border-t border-slate-100">
                            <a href="{{ route('viewRegistration', $registration) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-emerald-600 hover:border-emerald-200 hover:shadow-sm transition-all focus:ring-2 focus:ring-emerald-500" title="View Details">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </a>
                            <a href="{{ route('editRegistration', $registration) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-emerald-600 hover:border-emerald-200 hover:shadow-sm transition-all focus:ring-2 focus:ring-emerald-500" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button type="button" onclick="if(!confirm('Are you sure you want to delete this registration?')) { event.stopImmediatePropagation(); return false; }" wire:click="deleteRegistration({{ $registration->id }})" class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-600 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all focus:ring-2 focus:ring-rose-500" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>