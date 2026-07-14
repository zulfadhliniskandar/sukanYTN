<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Approve Registrations</h2>
        <p class="mt-2 text-sm text-gray-500">Review and manage pending sport registrations below.</p>
    </div>

    @if (session()->has('success'))
        <div class="mb-6 rounded-md bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($registrations->isEmpty())
        <div class="text-center bg-white rounded-xl shadow-sm border border-gray-100 p-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-2 text-sm font-semibold text-gray-900">No pending registrations</h3>
            <p class="mt-1 text-sm text-gray-500">All caught up! There are no registrations waiting for approval right now.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($registrations as $reg)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200 flex flex-col">
                    <!-- Card Header -->
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-start bg-gray-50/50">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 leading-tight">{{ $reg->groupName }}</h3>
                            <div class="mt-1 flex items-center text-sm text-blue-600 font-medium">
                                <svg class="mr-1.5 h-4 w-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                                </svg>
                                {{ $reg->sport->name }}
                            </div>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-yellow-50 px-2.5 py-1 text-xs font-semibold text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Pending</span>
                    </div>

                    <!-- Card Body -->
                    <div class="px-6 py-5 flex-1">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Team Members ({{ is_array($reg->name) ? count($reg->name) : 0 }})</h4>
                        <ul class="space-y-2">
                            @if(is_array($reg->name) || is_object($reg->name))
                                @foreach ($reg->name as $member)
                                    <li class="flex items-center text-sm text-gray-700 bg-gray-50 rounded-lg px-3 py-2">
                                        <div class="h-6 w-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0">
                                            {{ substr($member, 0, 1) }}
                                        </div>
                                        <span class="truncate">{{ $member }}</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-sm text-gray-500">No members listed</li>
                            @endif
                        </ul>
                    </div>

                    <!-- Card Footer Actions -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex gap-3 mt-auto">
                        <button wire:click="updateStatus('approved', {{ $reg->id }})" wire:loading.attr="disabled" class="flex-1 inline-flex justify-center items-center rounded-lg bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                            <svg class="-ml-0.5 mr-1.5 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Approve
                        </button>
                        <button wire:click="updateStatus('rejected', {{ $reg->id }})" wire:loading.attr="disabled" class="flex-1 inline-flex justify-center items-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors">
                            <svg class="-ml-0.5 mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Reject
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>