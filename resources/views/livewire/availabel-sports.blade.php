<div class="max-w-7xl mx-auto py-4">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b border-gray-200 pb-5 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Available Sports</h1>
            <p class="mt-2 text-sm text-slate-500">View all registered sports and their designated venues.</p>
        </div>
        @if(auth()->check() && auth()->user()->hasRole('Admin'))
            <a href="{{ route('createSports') }}" wire:navigate
                class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Sport
            </a>
        @endif
    </div>

    <!-- Sports Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($sports as $sport)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                <div class="flex flex-col justify-between h-full">
                    <div>
                        <div class="flex flex-wrap items-center justify-between mb-4 gap-2">
                            <h2 class="text-xl font-bold text-slate-800">{{ $sport->name }}</h2>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold tracking-wide uppercase {{ $sport->type === 'team' ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                                {{ $sport->type }}
                            </span>
                        </div>
                        
                        <a href="{{ route('athleteListForEachSport', $sport->id) }}" wire:navigate
                            class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-lg text-xs font-semibold text-gray-700 shadow-sm hover:bg-gray-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all mb-4">
                            <svg class="mr-1.5 h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Athletes ({{ $sport->registrations()->where('status', 'approved')->count() }})
                        </a>
                        
                        @if(auth()->check() && auth()->user()->hasRole('Admin'))
                            <div class="mb-4">
                                <a href="{{ route('listPIC', $sport->id) }}" wire:navigate
                                    class="inline-flex items-center justify-center px-4 py-2 bg-slate-50 text-slate-700 border border-slate-300 font-semibold rounded-lg shadow-sm hover:bg-slate-100 hover:text-slate-900 transition-all text-sm w-full">
                                    Manage PICs
                                </a>
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <div class="pt-4 border-t border-slate-100">
                            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Venue Location</p>
                            <a href="{{ $sport->venue->map_url ?? '#' }}" target="_blank"
                                class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors group">
                                <span class="bg-blue-50 p-1.5 rounded-md mr-2 group-hover:bg-blue-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </span>
                                {{ $sport->venue->name ?? 'Unknown Venue' }}
                            </a>
                        </div>

                        @if(auth()->check() && auth()->user()->hasRole('Admin'))
                            <div class="mt-4 pt-4 border-t border-slate-100 flex gap-3 justify-end">
                                <a href="{{ route('editSport', $sport->id) }}" wire:navigate
                                    class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                                <button wire:confirm="Are you sure you want to delete this sport?"
                                    wire:click="deleteSport({{ $sport->id }})"
                                    class="text-sm font-medium text-red-600 hover:text-red-800 transition-colors">Delete</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-slate-50 border border-slate-200 border-dashed rounded-2xl p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">No sports found</h3>
                <p class="mt-1 text-sm text-slate-500">Get started by creating a new sport.</p>
                <div class="mt-6">
                    <a href="{{ route('createSports') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Add Sport
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>