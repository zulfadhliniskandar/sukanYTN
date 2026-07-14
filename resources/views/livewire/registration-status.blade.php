<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Registration Status</h2>
            <p class="mt-2 text-sm text-gray-500">Track the approval status of your sport registrations.</p>
        </div>
        <div>
            <a href="{{ route('registerSport') }}" wire:navigate class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-blue-600 text-white font-medium text-sm rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Registration
            </a>
        </div>
    </div>

    @if ($registrations->isEmpty())
        <div class="text-center bg-white rounded-2xl shadow-sm border border-slate-100 p-16">
            <svg class="mx-auto h-16 w-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-4 text-lg font-bold text-slate-900">No Registrations Found</h3>
            <p class="mt-2 text-sm text-slate-500 max-w-sm mx-auto">You haven't registered for any sports yet. Click the button above to get started.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($registrations as $registration)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-200 flex flex-col relative group">
                    <!-- Status Badge -->
                    <div class="absolute top-5 right-5 z-10">
                        @if($registration->status === 'approved')
                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 ring-1 ring-inset ring-emerald-600/20 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Approved
                            </span>
                        @elseif($registration->status === 'rejected')
                            <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 ring-1 ring-inset ring-red-600/20 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                Rejected
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/20 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Pending
                            </span>
                        @endif
                    </div>

                    <!-- Card Header Background (adds visual flair) -->
                    <div class="h-20 bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-100"></div>

                    <!-- Card Content -->
                    <div class="p-6 -mt-10 relative">
                        <!-- Sport Icon Box -->
                        <div class="h-16 w-16 rounded-2xl bg-white border border-slate-100 shadow-sm flex items-center justify-center text-blue-600 mb-4 bg-gradient-to-br from-white to-blue-50">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>

                        <div class="mb-5">
                            <h3 class="text-xl font-extrabold text-slate-900 leading-tight mb-1">{{ $registration->sport->name }}</h3>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">{{ $registration->sport->type }} Sport</span>
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 mb-5 group-hover:bg-blue-50/50 transition-colors">
                            @if($registration->sport->type === 'team')
                                <p class="text-xs text-slate-500 font-semibold mb-1 uppercase tracking-wider">Team / Group Name</p>
                                <p class="text-sm font-bold text-slate-800">{{ $registration->groupName ?? 'N/A' }}</p>
                            @else
                                <p class="text-xs text-slate-500 font-semibold mb-1 uppercase tracking-wider">Participant</p>
                                <p class="text-sm font-bold text-slate-800">{{ $user->name ?? 'Individual' }}</p>
                            @endif
                        </div>
                        
                        <div class="flex items-center gap-1.5 text-xs text-slate-400 font-medium mt-auto">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Submitted on {{ $registration->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>