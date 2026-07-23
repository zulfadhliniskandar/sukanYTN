<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">

    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-[20%] right-[-5%] w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center items-start mb-8 sm:mb-10 pb-6 border-b border-slate-200 gap-4 sm:gap-6">
        <div>
            <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm mb-3">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-500 mr-2 animate-pulse"></span>
                Match Settings
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Edit Match Details</h1>
            <p class="mt-2 text-sm sm:text-base text-slate-500">Modify title, sport classification, status, schedule, and view participants.</p>
        </div>
        
        <a href="{{ route('listMatch') }}" wire:navigate
            class="inline-flex items-center justify-center px-5 py-2.5 bg-white hover:bg-slate-50 text-slate-700 text-xs font-bold rounded-xl border border-slate-200 shadow-xs hover:shadow-sm transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Matches
        </a>
    </div>

    <!-- Main Card -->
    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-6 sm:p-10">

        @if(session('success'))
            <div class="mb-8 p-4 rounded-2xl bg-emerald-50 text-emerald-700 text-sm font-bold border border-emerald-100 flex items-center gap-3">
                <svg class="w-5 h-5 shrink-0 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form wire:submit="updateMatch" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="col-span-full">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Match Title
                    </label>
                    <input type="text" wire:model="title"
                        class="w-full px-4 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-slate-900 text-sm font-medium transition-all shadow-xs"
                        placeholder="e.g. Badminton Men Singles - Finals">
                    @error('title') <span class="text-xs text-rose-500 font-semibold mt-1.5 block">{{ $message }}</span> @enderror
                </div>

                <!-- Sport -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Sport Category
                    </label>
                    <select wire:model="sport_id"
                        class="w-full px-4 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-slate-900 text-sm font-medium transition-all shadow-xs">
                        <option value="">Select Sport Category</option>
                        @foreach($sports as $sport)
                            <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                        @endforeach
                    </select>
                    @error('sport_id') <span class="text-xs text-rose-500 font-semibold mt-1.5 block">{{ $message }}</span> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Match Status
                    </label>
                    <select wire:model="status"
                        class="w-full px-4 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-slate-900 text-sm font-medium transition-all shadow-xs capitalize">
                        <option value="scheduled">Scheduled</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="finished">Finished</option>
                    </select>
                    @error('status') <span class="text-xs text-rose-500 font-semibold mt-1.5 block">{{ $message }}</span> @enderror
                </div>

                <!-- Start Time -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Start Time
                    </label>
                    <input type="datetime-local" wire:model="start_time"
                        class="w-full px-4 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-slate-900 text-sm font-medium transition-all shadow-xs">
                    @error('start_time') <span class="text-xs text-rose-500 font-semibold mt-1.5 block">{{ $message }}</span> @enderror
                </div>

                <!-- End Time -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        End Time (Optional)
                    </label>
                    <input type="datetime-local" wire:model="end_time"
                        class="w-full px-4 py-3.5 rounded-2xl border border-slate-200 bg-slate-50/50 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 text-slate-900 text-sm font-medium transition-all shadow-xs">
                    @error('end_time') <span class="text-xs text-rose-500 font-semibold mt-1.5 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Participants Preview Section -->
            @if($match->participants->count() > 0)
                <div class="pt-8 border-t border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-700 flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Match Participants & Live Score Preview
                        </h3>
                        <span class="text-xs text-slate-500 font-medium">{{ $match->participants->count() }} Competitors</span>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center bg-slate-50 p-6 rounded-2xl border border-slate-100 shadow-inner relative overflow-hidden gap-4">
                        @foreach($match->participants as $participant)
                            <div class="text-center flex-1 min-w-0">
                                <p class="text-sm font-bold truncate px-2 text-slate-900">
                                    {{ $participant->user->name ?? 'Participant' }}
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5 font-medium">
                                    {{ $participant->contingent->name ?? 'No Contingent' }}
                                </p>
                                <div class="text-4xl font-black text-indigo-600 mt-2 tracking-tight">
                                    {{ $participant->score }}
                                </div>
                                @if($match->status === 'finished' && !empty($participant->results))
                                    <div class="mt-2">
                                        @switch($participant->results)
                                            @case('win')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wider">Winner</span>
                                                @break
                                            @case('lose')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-100 uppercase tracking-wider">Runner-up</span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200 uppercase tracking-wider">Draw</span>
                                        @endswitch
                                    </div>
                                @endif
                            </div>
                            @if(!$loop->last)
                                <div class="text-xs font-black text-slate-300 px-4 select-none sm:block">VS</div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Form Actions -->
            <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('listMatch') }}" wire:navigate
                    class="px-6 py-3 rounded-2xl border border-slate-200 text-slate-600 font-bold text-xs uppercase tracking-wider hover:bg-slate-50 transition-all">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold text-xs uppercase tracking-wider rounded-2xl shadow-md shadow-indigo-200 hover:from-indigo-700 hover:to-violet-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5 cursor-pointer">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>