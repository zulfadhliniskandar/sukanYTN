<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
            <h2 class="text-2xl font-extrabold text-white">Register for a Sport</h2>
            <p class="mt-2 text-blue-100 text-sm">Join a sports event as an individual or team.</p>
            <a href="{{ route('registrationStatus') }}" wire:navigate
                class="text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100 hover:bg-blue-100 transition-colors mt-3 inline-block">
                View Registration Status →
            </a>
        </div>

        <form wire:submit="store" class="p-8 space-y-8">
            <!-- Flash Message -->
            @if (session()->has('success'))
                <div
                    class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Sport Selection -->
            <div>
                <label for="sport_id" class="block text-sm font-semibold text-slate-700 mb-2">Select Sport</label>
                <select wire:model.live="sport_id" id="sport_id"
                    class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-slate-50 transition-colors">
                    <option value="">-- Choose a Sport --</option>
                    @foreach($sports as $sport)
                        <option value="{{ $sport->id }}">{{ $sport->name }} ({{ ucfirst($sport->type) }})</option>
                    @endforeach
                </select>
                @error('sport_id') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
            </div>

            @if($sportType)
                <div class="border-t border-slate-100 pt-8">
                    @if($sportType === 'team')
                        <div class="mb-8">
                            <label for="groupName" class="block text-sm font-semibold text-slate-700 mb-2">Team / Group
                                Name</label>
                            <input type="text" wire:model="groupName" id="groupName" placeholder="Enter your team name"
                                class="w-full rounded-xl border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-slate-50 transition-colors">
                            @error('groupName') <span class="text-sm text-red-500 mt-1">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-800">
                            {{ $sportType === 'team' ? 'Team Members' : 'Participant Details' }}
                        </h3>
                        @if($sportType === 'team')
                            <button type="button" wire:click="addMember"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 font-semibold text-sm rounded-lg hover:bg-blue-100 transition-colors border border-blue-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                                Add Member
                            </button>
                        @endif
                    </div>

                    <div class="space-y-4">
                        @foreach($name as $index => $val)
                            <div
                                class="bg-slate-50 p-5 rounded-xl border border-slate-200 relative group transition-all hover:border-blue-200 hover:shadow-md">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Full
                                            Name</label>
                                        <input type="text" wire:model="name.{{ $index }}" placeholder="e.g. John Doe"
                                            class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        @error('name.' . $index) <span
                                        class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Student
                                            ID</label>
                                        <input type="text" wire:model="student_id.{{ $index }}" placeholder="e.g. B032110011"
                                            class="w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        @error('student_id.' . $index) <span
                                        class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                @if($sportType === 'team' && count($name) > 1)
                                    <button type="button" wire:click="removeMember({{ $index }})"
                                        class="absolute -top-3 -right-3 bg-red-100 text-red-600 rounded-full p-1.5 border border-red-200 shadow-sm hover:bg-red-200 hover:text-red-700 transition-all opacity-0 group-hover:opacity-100 focus:opacity-100"
                                        title="Remove member">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-md hover:shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Submit Registration
                    </button>
                </div>
            @else
                <div class="text-center py-10 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                        </path>
                    </svg>
                    <p class="text-slate-500 text-sm font-medium">Select a sport above to view registration details.</p>
                </div>
            @endif
        </form>
    </div>
</div>