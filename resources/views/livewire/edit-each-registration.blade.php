<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    
    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('listApprovedRegistrations') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Approved Registrations
        </a>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-6 rounded-2xl bg-emerald-50 p-4 border border-emerald-100 flex items-center shadow-sm">
            <div class="flex-shrink-0 bg-emerald-100 rounded-full p-2 mr-4 text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <!-- Header Section -->
        <div class="relative px-8 py-8 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-indigo-400/20 rounded-full blur-xl"></div>
            
            <div class="relative flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-white/20 text-white backdrop-blur-md mb-3 border border-white/10 shadow-sm">
                        <svg class="mr-1.5 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Registration
                    </span>
                    <h1 class="text-3xl font-black text-white tracking-tight">
                        Update Details
                    </h1>
                    <p class="mt-2 text-indigo-100 text-sm max-w-xl">
                        Modify the registration details below and click save to apply changes.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form wire:submit="updateRegistration" class="px-8 py-8">
            <div class="space-y-8">
                
                @if ($isTeam)
                    <!-- Team Information Section -->
                    <div class="bg-slate-50/50 rounded-2xl p-6 border border-slate-100 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50/50 rounded-full blur-2xl -mt-10 -mr-10"></div>
                        <div class="relative">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Team Overview
                            </h3>
                            
                            <div class="w-full">
                                <label for="groupName" class="block text-sm font-semibold text-slate-700 mb-1.5">Group Name</label>
                                <input type="text" id="groupName" wire:model="groupName" 
                                    class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm text-slate-900 px-4 py-3 bg-white transition-colors placeholder:text-slate-400"
                                    placeholder="Enter team or group name">
                                @error('groupName') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Members Section -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm relative">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Team Roster</h3>
                                <p class="text-sm text-slate-500 mt-1">Manage team members</p>
                            </div>
                            <div class="bg-indigo-50 border border-indigo-100 rounded-lg px-4 py-2 text-center shadow-sm">
                                <span class="block text-xl font-black text-indigo-700 leading-none">{{ count($names) }}</span>
                                <span class="block text-[10px] font-bold text-indigo-500 uppercase mt-0.5 tracking-wider">Count</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            @foreach ($names as $index => $name)
                                <div class="group flex items-start sm:items-center gap-4 bg-slate-50 p-4 rounded-xl border border-slate-100 hover:border-indigo-200 hover:shadow-md transition-all duration-300">
                                    <div class="hidden sm:flex h-10 w-10 rounded-full bg-gradient-to-br from-indigo-50 to-violet-100 text-indigo-700 items-center justify-center text-sm font-bold border border-indigo-100 shadow-inner flex-shrink-0">
                                        {{ $index + 1 }}
                                    </div>
                                    
                                    <div class="flex-1 w-full">
                                        <label for="name_{{ $index }}" class="block sm:hidden text-xs font-semibold text-slate-500 uppercase mb-1">Member {{ $index + 1 }}</label>
                                        <input type="text" id="name_{{ $index }}" wire:model="names.{{ $index }}" 
                                            class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm text-slate-900 px-4 py-2.5 bg-white transition-colors"
                                            placeholder="Member Name">
                                        @error('names.'.$index) <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <button type="button" wire:click="removeAthlete({{ $index }})" 
                                        class="flex-shrink-0 mt-6 sm:mt-0 inline-flex items-center justify-center w-10 h-10 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 hover:border-red-100 border border-transparent transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1"
                                        title="Remove Member">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                            
                            @if(empty($names))
                                <div class="text-center py-8 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                                    <p class="text-slate-500 font-medium">No members left.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Add Member Button -->
                        <div class="mt-6 pt-6 border-t border-slate-100 flex justify-center">
                            <button type="button" wire:click="addAthlete" class="inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-700 font-bold text-sm rounded-xl border border-indigo-200 hover:bg-indigo-100 transition-colors shadow-sm focus:ring-2 focus:ring-indigo-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Add Team Member
                            </button>
                        </div>
                    </div>

                @else
                    <!-- Individual Athlete Section -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center border-b border-slate-100 pb-4">
                            <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Athlete Information
                        </h3>
                        
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name</label>
                            <input type="text" id="name" wire:model="names.0" 
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm text-slate-900 px-4 py-3 bg-white transition-colors"
                                placeholder="Enter athlete's name">
                            @error('names.0') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                @endif
                
            </div>

            <!-- Actions Footer -->
            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end gap-4">
                <a href="{{ url()->previous() }}" class="inline-flex items-center px-5 py-2.5 border border-slate-300 shadow-sm text-sm font-semibold rounded-xl text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                    Cancel
                </a>
                
                <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent shadow-md shadow-indigo-200 text-sm font-semibold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>