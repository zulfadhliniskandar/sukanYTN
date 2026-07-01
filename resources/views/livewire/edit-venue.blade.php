<div class="max-w-3xl mx-auto py-10">
    <!-- Header -->
    <div class="mb-8 border-b border-gray-200 pb-5">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
            Edit Venue
        </h2>
        <p class="mt-2 text-sm text-slate-500">
            Edit this location for the tournament events.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form wire:submit="updateVenue" class="p-8 space-y-6">
            <!-- Venue Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Venue Name <span
                        class="text-red-500">*</span></label>
                <input type="text" id="name" wire:model="name"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white"
                    value="{{$name}}" @error('name') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span>
                    @enderror
            </div>

            <!-- Coordinates Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="latitude" class="block text-sm font-semibold text-slate-700 mb-2">Latitude <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="latitude" wire:model="latitude"
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white"
                        value="{{$latitude}}">
                    @error('latitude') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="longitude" class="block text-sm font-semibold text-slate-700 mb-2">Longitude <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="longitude" wire:model="longitude"
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white"
                        value="{{$longitude}}">
                    @error('longitude') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Location Link -->
            <div>
                <label for="location_link" class="block text-sm font-semibold text-slate-700 mb-2">Google Maps Link
                    (Optional)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <input type="text" id="location_link" wire:model="location_link"
                        class="pl-10 w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white"
                        value="{{$location_link}}">
                </div>
                @error('location_link') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Description
                    (Optional)</label>
                <textarea id="description" wire:model="description" rows="4"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white resize-none">{{$description}}</textarea>
                @error('description') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
            </div>

            <!-- Actions -->
            <div class="pt-4 flex items-center justify-end border-t border-slate-100">
                <a href="{{ route('listVenue') }}" wire:navigate
                    class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors mr-4">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Save Venue
                </button>
            </div>
        </form>
    </div>
</div>