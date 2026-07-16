<div class="max-w-3xl mx-auto py-10">
    <!-- Header -->
    <div class="mb-8 border-b border-gray-200 pb-5">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
            Create Sport
        </h2>
        <p class="mt-2 text-sm text-slate-500">
            Register a new sport event and assign it to a venue.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form wire:submit="save" class="p-8 space-y-6">
            <!-- Sport Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Sport Name <span
                        class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="text" id="name" wire:model="name"
                        class="pl-10 w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white"
                        placeholder="e.g. Men's 100m Sprint">
                </div>
                @error('name') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Venue Selection -->
                <div>
                    <label for="venue" class="block text-sm font-semibold text-slate-700 mb-2">Venue <span
                            class="text-red-500">*</span></label>
                    <select id="venue" wire:model="venue"
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white">
                        <option value="">-- Select a Venue --</option>
                        @foreach($venues as $v)
                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                        @endforeach
                    </select>
                    @error('venue') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>

                <!-- Type Selection -->
                <div>
                    <label for="type" class="block text-sm font-semibold text-slate-700 mb-2">Event Type <span
                            class="text-red-500">*</span></label>
                    <select id="type" wire:model="type"
                        class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white">
                        <option value="">-- Select Type --</option>
                        <option value="individual">Individual Event</option>
                        <option value="team">Team Event</option>
                    </select>
                    @error('type') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-4 flex items-center justify-end border-t border-slate-100">
                <a href="{{ route('listSport') }}" wire:navigate
                    class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors mr-4">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Sport
                </button>
            </div>
        </form>
    </div>
</div>