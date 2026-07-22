<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob"></div>
        <div class="absolute bottom-[10%] right-[10%] w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob animation-delay-2000"></div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <!-- Header Banner -->
        <div class="relative px-8 py-8 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-850 overflow-hidden flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">Register for a Sport</h2>
                <p class="mt-1 text-indigo-100 text-sm">Join a sports event as an individual or team.</p>
            </div>
            <div>
                <a href="{{ route('registrationStatus') }}" wire:navigate
                    class="inline-flex items-center justify-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-bold rounded-xl border border-white/10 backdrop-blur-md transition-all shadow-sm">
                    View Registration Status →
                </a>
            </div>
        </div>

        <form wire:submit="store" class="p-8 space-y-8">
            <!-- Flash Message -->
            @if (session()->has('success'))
                <div class="mb-8 rounded-2xl bg-emerald-50 p-4 border border-emerald-100 flex items-center shadow-sm">
                    <div class="flex-shrink-0 bg-emerald-100 rounded-full p-2 mr-4 text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Sport Selection -->
            <div>
                <label for="sport_id" class="block text-sm font-bold text-slate-700 mb-2">Select Sport</label>
                <select wire:model.live="sport_id" id="sport_id"
                    class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 text-sm transition-colors focus:bg-white">
                    <option value="">-- Choose a Sport --</option>
                    @foreach($sports as $sport)
                        <option value="{{ $sport->id }}">{{ $sport->name }} ({{ ucfirst($sport->type) }})</option>
                    @endforeach
                </select>
                @error('sport_id') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
            </div>

            @if($sportType)
                <div class="border-t border-slate-100 pt-8">
                    @if($sportType === 'team')
                        <div class="mb-8">
                            <label for="groupName" class="block text-sm font-bold text-slate-700 mb-2">Team / Group Name</label>
                            <input type="text" wire:model="groupName" id="groupName" placeholder="Enter your team name"
                                class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 transition-colors focus:bg-white text-sm">
                            @error('groupName') <span class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-slate-800">
                            {{ $sportType === 'team' ? 'Team Members' : 'Participant Details' }}
                        </h3>
                        @if($sportType === 'team')
                            <button type="button" wire:click="addMember"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-50 text-indigo-700 font-bold text-sm rounded-xl hover:bg-indigo-100 transition-all border border-indigo-200/50 shadow-sm">
                                <svg class="w-4.5 h-4.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                                Add Member
                            </button>
                        @endif
                    </div>

                    <div class="space-y-4">
                        @foreach($name as $index => $val)
                            <div wire:key="member-{{ $index }}"
                                class="bg-slate-50/50 p-5 rounded-2xl border border-slate-200 relative group transition-all hover:border-indigo-200 hover:shadow-md">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Full Name</label>
                                        <input type="text" wire:model="name.{{ $index }}" placeholder="e.g. John Doe"
                                            class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-white py-2.5 text-slate-800 text-sm">
                                        @error('name.' . $index) <span class="text-xs font-semibold text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Student ID</label>
                                        <input type="text" wire:model="student_id.{{ $index }}" placeholder="e.g. B032110011"
                                            class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-white py-2.5 text-slate-800 text-sm">
                                        @error('student_id.' . $index) <span class="text-xs font-semibold text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                @if($sportType === 'team' && count($name) > 1)
                                    <button type="button" wire:click="removeMember({{ $index }})"
                                        class="absolute -top-3 -right-3 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-full p-2 border border-rose-200 shadow-sm transition-all opacity-0 group-hover:opacity-100 focus:opacity-100"
                                        title="Remove member">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
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
                        class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Submit Registration
                    </button>
                </div>
            @else
                <div class="text-center py-12 bg-slate-50/50 rounded-3xl border border-dashed border-slate-200">
                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122">
                        </path>
                    </svg>
                    <p class="text-slate-500 text-sm font-semibold">Select a sport above to view registration details.</p>
                </div>
            @endif
        </form>
    </div>
</div>