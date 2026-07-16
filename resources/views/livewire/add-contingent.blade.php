<div class="max-w-3xl mx-auto py-10">
    <!-- Header -->
    <div class="mb-8 border-b border-gray-200 pb-5">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
            Add New Contingent
        </h2>
        <p class="mt-2 text-sm text-slate-500">
            Register a new contingent for the tournament events.
        </p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form wire:submit="save" class="p-8 space-y-6">
            <!-- Contingent Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Contingent Name <span
                        class="text-red-500">*</span></label>
                <input type="text" id="name" wire:model="name"
                    class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors bg-slate-50 focus:bg-white"
                    placeholder="e.g. Rumah Kuning">
                @error('name') <span class="mt-1 text-sm text-red-600 block">{{ $message }}</span> @enderror
            </div>
            <!-- Actions -->
            <div class="pt-4 flex items-center justify-end border-t border-slate-100">
                <a href="{{ route('listContingents') }}" wire:navigate
                    class="px-6 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors mr-4">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Save Contingent
                </button>
            </div>
        </form>
    </div>
</div>