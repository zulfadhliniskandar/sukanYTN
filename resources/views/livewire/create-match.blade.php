<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob"></div>
        <div class="absolute bottom-[10%] right-[10%] w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('listMatch') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-650 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Match List
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <!-- Header Banner -->
        <div class="relative px-8 py-6 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <h2 class="text-2xl font-black text-white tracking-tight">Create Match</h2>
            <p class="mt-1.5 text-indigo-100 text-sm">Schedule a new match or event for a specific sport.</p>
        </div>

        <form wire:submit="save" class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Sport Selection -->
                <div>
                    <label for="sport" class="block text-sm font-bold text-slate-700 mb-2">Sport <span class="text-rose-500">*</span></label>
                    <select id="sport" wire:model="sport" 
                        class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 text-sm transition-colors focus:bg-white">
                        <option value="">-- Select Sport --</option>
                        @foreach ($sports as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                    @error('sport') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Status Selection -->
                <div>
                    <label for="status" class="block text-sm font-bold text-slate-700 mb-2">Status <span class="text-rose-500">*</span></label>
                    <select id="status" wire:model="status" 
                        class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 text-sm transition-colors focus:bg-white">
                        <option value="scheduled">Scheduled</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="finished">Finished</option>
                    </select>
                    @error('status') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-bold text-slate-700 mb-2">Match Title <span class="text-rose-500">*</span></label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <input type="text" id="title" wire:model="title" 
                        class="pl-11 block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 transition-colors focus:bg-white text-sm" 
                        placeholder="e.g. Semi-Finals Group A">
                </div>
                @error('title') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Start Time -->
                <div>
                    <label for="start_time" class="block text-sm font-bold text-slate-700 mb-2">Start Time</label>
                    <input type="datetime-local" id="start_time" wire:model="start_time" 
                        class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 text-sm transition-colors focus:bg-white">
                    @error('start_time') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- End Time -->
                <div>
                    <label for="end_time" class="block text-sm font-bold text-slate-700 mb-2">End Time</label>
                    <input type="datetime-local" id="end_time" wire:model="end_time" 
                        class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 text-sm transition-colors focus:bg-white">
                    @error('end_time') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-6 flex items-center justify-end border-t border-slate-100 gap-3">
                <a href="{{ route('listMatch') }}" wire:navigate class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-all">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Schedule Match
                </button>
            </div>
        </form>
    </div>
</div>