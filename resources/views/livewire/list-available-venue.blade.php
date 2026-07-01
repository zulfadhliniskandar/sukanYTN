<div class="max-w-4xl mx-auto py-10">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-5">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Available Venue</h1>
            <p class="mt-2 text-sm text-slate-500">View all registered Venues and their designated sports.</p>
        </div>
        <a href="{{ route('addVenue') }}" wire:navigate
            class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Venue
        </a>
    </div>

    <div class="grid gap-6">
        @foreach ($venues as $venue)
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                <h2 class="text-xl font-bold text-slate-800">{{ $venue->name }}</h2>
                <div>
                    <a href="{{ route('editVenue', $venue->id) }}" wire:navigate
                        class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                    <button wire:confirm="Are you sure you want to delete this venue?"
                        wire:click="deleteVenue({{$venue->id}})" wire:navigate
                        class="text-sm font-medium text-red-600 hover:text-blue-800 transition-colors">Delete</button>
                </div>
                @if($venue->description)
                    <p class="text-slate-600 mt-2">{{ $venue->description }}</p>
                @endif

                <div class="mt-4">
                    <a href="{{ $venue->map_url }}" target="_blank"
                        class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        View on Google Maps
                    </a>
                </div>

                @if($venue->sports->count() > 0)
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Sports Hosted Here:</h3>
                        <ul class="flex flex-wrap gap-2">
                            @foreach($venue->sports as $sport)
                                <li class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $sport->name }} ({{ ucfirst($sport->type) }})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>