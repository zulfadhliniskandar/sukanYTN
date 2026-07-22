<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-[20%] right-[-5%] w-72 h-72 bg-violet-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-[-10%] left-[20%] w-80 h-80 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header Section with Back Navigation -->
    <div class="mb-8">
        <a href="{{ route('listContingents') }}" wire:navigate class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors mb-6 group">
            <div class="w-8 h-8 rounded-full bg-white shadow-sm border border-slate-200 flex items-center justify-center mr-3 group-hover:bg-indigo-50 group-hover:border-indigo-200 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </div>
            Back to Contingents
        </a>

        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/50 border border-white p-6 sm:p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-indigo-100 to-violet-100 rounded-full blur-3xl -mr-20 -mt-20 opacity-60"></div>
            
            <div class="relative z-10 flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4 sm:gap-6">
                <div class="h-20 w-20 sm:h-24 sm:w-24 rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white text-3xl sm:text-4xl font-black shadow-lg shadow-indigo-200/50 flex-shrink-0">
                    {{ strtoupper(substr($contingent->name, 0, 1)) }}
                </div>
                
                <div>
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 mb-2">
                        Contingent Details
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-2">{{ $contingent->name }}</h1>
                    <p class="text-slate-500 font-medium text-sm sm:text-base">Managing {{ $registrations->count() }} registered athlete(s)/team(s)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Registrations Table Card -->
    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100/60 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="text-xl font-bold text-slate-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Registrations
                <span class="ml-3 px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 text-sm">{{ $registrations->count() }}</span>
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Name</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Sport</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/60 bg-white/40">
                    @forelse($registrations as $registration)
                        <tr wire:key="registration-{{ $registration->id }}" class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-indigo-100 to-violet-100 flex items-center justify-center shadow-inner border border-indigo-50">
                                        <span class="text-indigo-700 font-bold text-sm">
                                            {{ strtoupper(substr(is_array($registration->name) ? $registration->name[0] : $registration->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-slate-900 group-hover:text-indigo-600 transition-colors">
                                            @if(is_array($registration->name))
                                                {{ implode(', ', $registration->name) }}
                                            @else
                                                {{ $registration->name }}
                                            @endif
                                        </div>
                                        @if($registration->groupName)
                                            <div class="text-xs font-medium text-slate-500 mt-0.5">{{ $registration->groupName }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-8 py-5">
                                <div class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $registration->sport->name ?? 'Unknown Sport' }}
                                </div>
                            </td>

                            <td class="px-8 py-5">
                                @if(strtolower($registration->status) === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        Approved
                                    </span>
                                @elseif(strtolower($registration->status) === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-200 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5"></span>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-full bg-rose-50 text-rose-700 border border-rose-200 shadow-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                        {{ ucfirst($registration->status) }}
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('editRegistration', $registration->id) }}" wire:navigate class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm transition-all focus:ring-2 focus:ring-indigo-500" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <button type="button" onclick="if(!confirm('Are you sure you want to remove this registration from the contingent?')) { event.stopImmediatePropagation(); return false; }" wire:click="deleteRegistration({{ $registration->id }})" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all focus:ring-2 focus:ring-rose-500" title="Remove from Contingent">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-16 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-300 mb-4 border border-slate-100">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 mb-1">No registrations found</h3>
                                <p class="text-sm text-slate-500">This contingent doesn't have any registered members yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>