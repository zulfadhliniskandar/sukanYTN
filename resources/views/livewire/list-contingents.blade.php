<div class="max-w-4xl mx-auto py-10">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-5">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Available Contingents</h1>
            <p class="mt-2 text-sm text-slate-500">View all registered Contingents for this tournaments.</p>
        </div>
        @if(auth()->check() && auth()->user()->hasRole('Admin'))
            <a href="{{ route('addContingent') }}" wire:navigate
                class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Contingent
            </a>
        @endif
    </div>

    <div class="grid gap-6">
        @foreach ($contingents as $contingent)
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                <h2 class="text-xl font-bold text-slate-800">{{ $contingent->name }}</h2>
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                    <div>
                        <a href="{{ route('editContingent', $contingent->id) }}" wire:navigate
                            class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                        <button wire:confirm="Are you sure you want to delete this contingent?"
                            wire:click="deleteContingent({{$contingent->id}})" wire:navigate
                            class="text-sm font-medium text-red-600 hover:text-blue-800 transition-colors">Delete</button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>