<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">

    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div
            class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob">
        </div>
        <div
            class="absolute bottom-[10%] right-[10%] w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-blob animation-delay-2000">
        </div>
    </div>

    <!-- Back Navigation -->
    <div class="mb-6">
        <a href="{{ route('listMatch') }}" wire:navigate
            class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-650 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Match List
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <!-- Header Banner -->
        <div class="relative px-8 py-6 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 overflow-hidden">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            <h2 class="text-2xl font-black text-white tracking-tight font-black">Assign Match Participants</h2>
            <p class="mt-1.5 text-indigo-100 text-sm">Select a match and choose two participating athletes or teams.</p>
        </div>

        <form wire:submit="saveParticipant" class="p-8 space-y-6">
            <!-- Flash Message -->
            @if (session()->has('success'))
                <div class="rounded-2xl bg-emerald-50 p-4 border border-emerald-100 flex items-center shadow-sm">
                    <div class="flex-shrink-0 bg-emerald-100 rounded-full p-2 mr-4 text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Select Match -->
            <div>
                <label for="selectedMatch" class="block text-sm font-bold text-slate-700 mb-2">Match / Event <span
                        class="text-rose-500">*</span></label>
                <select wire:model.live="selectedMatch" id="selectedMatch"
                    class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 text-sm transition-colors focus:bg-white">
                    <option value="">-- Choose a Match --</option>
                    @foreach ($matches as $match)
                        <option value="{{ $match->id }}">{{ $match->title }} ({{ $match->sport->name ?? 'Unknown' }})
                        </option>
                    @endforeach
                </select>
                @error('selectedMatch') <span
                class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center pt-4 border-t border-slate-100 relative my-4">
                <!-- Participant 1 -->
                <div>
                    <label for="participant1" class="block text-sm font-bold text-slate-700 mb-2">Participant 1 <span
                            class="text-rose-500">*</span></label>
                    <select wire:model="participant1" id="participant1"
                        class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 text-sm transition-colors focus:bg-white">
                        <option value="">Select Participant 1</option>
                        @foreach ($registrations as $registration)
                            <option value="{{ $registration->id }}">
                                {{ $registration->sport->type === 'team' ? $registration->groupName : (is_array($registration->name) ? implode(', ', $registration->name) : $registration->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('participant1') <span
                    class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- VS Divider/Indicator -->
                <div
                    class="hidden md:flex absolute left-1/2 top-1/2 -translate-x-1/2 translate-y-1 z-10 items-center justify-center">
                    <span
                        class="w-10 h-10 rounded-full bg-slate-100 text-slate-400 border border-slate-200 flex items-center justify-center text-xs font-black select-none shadow-sm ml-2 mr-2">VS</span>
                </div>

                <!-- Participant 2 -->
                <div>
                    <label for="participant2" class="block text-sm font-bold text-slate-700 mb-2">Participant 2 <span
                            class="text-rose-500">*</span></label>
                    <select wire:model="participant2" id="participant2"
                        class="block w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner bg-slate-50/50 py-3 text-slate-800 text-sm transition-colors focus:bg-white">
                        <option value="">Select Participant 2</option>
                        @foreach ($registrations as $registration)
                            <option value="{{ $registration->id }}">
                                {{ $registration->sport->type === 'team' ? $registration->groupName : (is_array($registration->name) ? implode(', ', $registration->name) : $registration->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('participant2') <span
                    class="mt-1.5 text-xs text-rose-600 block font-semibold">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-6 flex items-center justify-end border-t border-slate-100 gap-3">
                <a href="{{ route('listMatch') }}" wire:navigate
                    class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-all">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Save Participants
                </button>
            </div>
        </form>
    </div>
</div>