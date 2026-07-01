<div class="max-w-3xl mx-auto py-10">
    <!-- Header -->
    <div class="mb-8 border-b border-gray-200 pb-5">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
            Create Match
        </h2>
        <p class="mt-2 text-sm text-slate-500">
            Schedule a new match or event for a specific sport.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form wire:submit="save" class="p-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Sport Selection -->
                <div>
                    <label for="sport" class="block text-sm font-semibold text-slate-700 mb-2">Sport <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="sport" wire:model="sport" 
                            class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white">
                            <option value="">-- Select Sport --</option>
                            @foreach ($sports as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('sport') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>

                <!-- Status Selection -->
                <div>
                    <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select id="status" wire:model="status" 
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white">
                        <option value="scheduled">Scheduled</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="finished">Finished</option>
                    </select>
                    @error('status') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Match Title <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <input type="text" id="title" wire:model="title" 
                        class="pl-10 w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white" 
                        placeholder="e.g. Semi-Finals Group A">
                </div>
                @error('title') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Start Time -->
                <div>
                    <label for="start_time" class="block text-sm font-semibold text-slate-700 mb-2">Start Time</label>
                    <input type="datetime-local" id="start_time" wire:model="start_time" 
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white text-sm">
                    @error('start_time') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>

                <!-- End Time -->
                <div>
                    <label for="end_time" class="block text-sm font-semibold text-slate-700 mb-2">End Time</label>
                    <input type="datetime-local" id="end_time" wire:model="end_time" 
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white text-sm">
                    @error('end_time') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-6 flex items-center justify-end border-t border-slate-100 mt-6">
                <a href="{{ route('listMatch') }}" wire:navigate class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors mr-4">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Schedule Match
                </button>
            </div>
        </form>
    </div>
</div>