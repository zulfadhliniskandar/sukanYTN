<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b border-gray-200 pb-5 gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Approve Registrations</h2>
            <p class="mt-2 text-sm text-slate-500">Review and manage pending sport registrations below.</p>
        </div>
        @if(auth()->check() && auth()->user()->hasRole('Admin'))
            <a href="{{ route('listApprovedRegistrations') }}" wire:navigate
                class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                View Approved
            </a>
        @endif
    </div>
    
    @if (session()->has('success'))
        <div class="mb-8 rounded-lg bg-emerald-50 p-4 border border-emerald-200 shadow-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-emerald-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($registrations->isEmpty())
        <div class="text-center bg-white rounded-2xl shadow-sm border border-slate-200 p-16">
            <div class="mx-auto h-20 w-20 rounded-full bg-slate-50 flex items-center justify-center mb-4">
                <svg class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="mt-2 text-lg font-bold text-slate-900">No pending registrations</h3>
            <p class="mt-2 text-sm text-slate-500">All caught up! There are no registrations waiting for approval right now.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($registrations as $reg)
                @if($reg->sport && $reg->sport->type == 'team')
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col">
                        <!-- Card Header -->
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-start bg-gradient-to-r from-indigo-50/50 to-white">
                            <div>
                                <div class="text-xs font-semibold text-indigo-600 mb-1 uppercase tracking-wider">{{ $reg->sport->name }}</div>
                                <h3 class="text-xl font-bold text-slate-900 leading-tight">{{ $reg->groupName }}</h3>
                            </div>
                            <span
                                class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                        </div>

                        <!-- Card Body -->
                        <div class="px-6 py-5 flex-1 bg-white">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Team Members
                                ({{ is_array($reg->name) ? count($reg->name) : 0 }})</h4>
                            <ul class="space-y-3">
                                @if(is_array($reg->name) || is_object($reg->name))
                                    @foreach ($reg->name as $member)
                                        <li class="flex items-center text-sm font-medium text-slate-700">
                                            <div
                                                class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold mr-3 border border-indigo-200 shadow-sm flex-shrink-0">
                                                {{ substr($member, 0, 1) }}
                                            </div>
                                            <span class="truncate">{{ $member }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-sm text-slate-500 italic">No members listed</li>
                                @endif
                            </ul>
                        </div>

                        <!-- Card Footer Actions -->
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex gap-3 mt-auto">
                            <button wire:click="updateStatus('approved', {{ $reg->id }})" wire:loading.attr="disabled"
                                class="flex-1 inline-flex justify-center items-center rounded-xl bg-blue-600 px-3 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Approve
                            </button>
                            <button wire:click="updateStatus('rejected', {{ $reg->id }})" wire:loading.attr="disabled"
                                class="flex-1 inline-flex justify-center items-center rounded-xl bg-white px-3 py-2.5 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-colors">
                                <svg class="-ml-1 mr-2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reject
                            </button>
                        </div>
                    </div>
                @else
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col">
                        <!-- Card Header -->
                        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-start bg-gradient-to-r from-emerald-50/50 to-white">
                            <div>
                                <div class="text-xs font-semibold text-emerald-600 mb-1 uppercase tracking-wider">{{ $reg->sport->name ?? 'Unknown Sport' }}</div>
                                <h3 class="text-xl font-bold text-slate-900 leading-tight">Individual</h3>
                            </div>
                            <span
                                class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-600/20">Pending</span>
                        </div>

                        <!-- Card Body -->
                        <div class="px-6 py-5 flex-1 bg-white">
                            <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Athlete Details</h4>
                            <div class="flex items-center">
                                <div
                                    class="h-12 w-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-lg font-bold shadow-sm">
                                    {{ substr($reg->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-slate-900">{{ $reg->user->name ?? 'Unknown User' }}</h3>
                                    <p class="text-sm text-slate-500">{{ $reg->user->email ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer Actions -->
                        <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex gap-3 mt-auto">
                            <button wire:click="updateStatus('approved', {{ $reg->id }})" wire:loading.attr="disabled"
                                class="flex-1 inline-flex justify-center items-center rounded-xl bg-blue-600 px-3 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Approve
                            </button>
                            <button wire:click="updateStatus('rejected', {{ $reg->id }})" wire:loading.attr="disabled"
                                class="flex-1 inline-flex justify-center items-center rounded-xl bg-white px-3 py-2.5 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-colors">
                                <svg class="-ml-1 mr-2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reject
                            </button>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>