<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob"></div>
        <div class="absolute bottom-[10%] right-[10%] w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('listVenue') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Available Venues
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <!-- Header Banner -->
        <div class="relative px-8 py-6 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <h2 class="text-2xl font-black text-white tracking-tight">Add New Venue</h2>
            <p class="mt-1.5 text-indigo-100 text-sm">Register a new location for the tournament events.</p>
        </div>

        <form wire:submit="save" class="p-8 space-y-6">
            <!-- Venue Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Venue Name <span class="text-rose-500">*</span></label>
                <input type="text" id="name" wire:model="name"
                    class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 transition-colors focus:bg-white text-sm"
                    placeholder="e.g. Stadium Bukit Jalil">
                @error('name') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <!-- Coordinates Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="latitude" class="block text-sm font-bold text-slate-700 mb-2">Latitude <span class="text-rose-500">*</span></label>
                    <input type="text" id="latitude" wire:model="latitude"
                        class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 transition-colors focus:bg-white text-sm"
                        placeholder="e.g. 3.054320">
                    @error('latitude') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="longitude" class="block text-sm font-bold text-slate-700 mb-2">Longitude <span class="text-rose-500">*</span></label>
                    <input type="text" id="longitude" wire:model="longitude"
                        class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 transition-colors focus:bg-white text-sm"
                        placeholder="e.g. 101.691116">
                    @error('longitude') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Location Link -->
            <div>
                <label for="location_link" class="block text-sm font-bold text-slate-700 mb-2">Google Maps Link (Optional)</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <input type="text" id="location_link" wire:model="location_link"
                        class="pl-11 block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 transition-colors focus:bg-white text-sm"
                        placeholder="https://maps.google.com/...">
                </div>
                @error('location_link') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-bold text-slate-700 mb-2">Description (Optional)</label>
                <textarea id="description" wire:model="description" rows="4"
                    class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 transition-colors focus:bg-white resize-none text-sm"
                    placeholder="Enter any additional details about the venue..."></textarea>
                @error('description') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <!-- Actions -->
            <div class="pt-6 flex items-center justify-end border-t border-slate-100 gap-3">
                <a href="{{ route('listVenue') }}" wire:navigate
                    class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-all">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Save Venue
                </button>
            </div>
        </form>
    </div>
</div>