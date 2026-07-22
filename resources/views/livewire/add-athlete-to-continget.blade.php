<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob"></div>
        <div class="absolute bottom-[10%] right-[10%] w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('listApprovedRegistrations') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-650 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Approved List
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <!-- Header Banner -->
        <div class="relative px-8 py-6 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <h2 class="text-2xl font-black text-white tracking-tight">Add Athlete to Contingent</h2>
            <p class="mt-1.5 text-indigo-100 text-sm">Assign the selected registration to a specific contingent.</p>
        </div>

        <div class="p-8">
            <div class="mb-8 p-5 bg-slate-50 rounded-2xl border border-slate-100">
                <div class="text-xs font-bold text-indigo-600 mb-3 uppercase tracking-widest">
                    Registration Details
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Sport</div>
                        <div class="font-bold text-slate-900 capitalize">{{ $registration->sport->name ?? 'Unknown' }}</div>
                    </div>
                    
                    <div>
                        @if ($registration->sport->type == 'team')
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Group Name</div>
                            <div class="font-bold text-slate-900">{{$registration->groupName}}</div>
                        @else
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Athlete Name</div>
                            <div class="font-bold text-slate-900">{{ is_array($registration->name) ? implode(', ', $registration->name) : $registration->name }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <form wire:submit="save" class="space-y-6">
                <div>
                    <label for="contingent" class="block text-sm font-bold text-slate-700 mb-2">Select Contingent</label>
                    <select wire:model="contingent" id="contingent" 
                        class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 text-sm transition-colors focus:bg-white">
                        <option value="">-- Choose a Contingent --</option>
                        @foreach ($contingents as $contingentItem)
                            <option value="{{ $contingentItem->id }}">{{ $contingentItem->name }}</option>
                        @endforeach
                    </select>
                    @error('contingent') 
                        <p class="mt-2 text-xs text-rose-600 font-semibold flex items-center">
                            <svg class="w-4 h-4 mr-1 flex-shrink-0 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p> 
                    @enderror
                </div>

                <!-- Actions -->
                <div class="pt-6 flex items-center justify-end border-t border-slate-100 gap-3">
                    <a href="{{ route('listApprovedRegistrations') }}" wire:navigate
                        class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-all">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Save to Contingent
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>