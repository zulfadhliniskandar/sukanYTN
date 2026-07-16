<div class="max-w-4xl mx-auto py-10">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-5">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">List Approved Registration</h1>
            <p class="mt-2 text-sm text-slate-500">View all approved registrations for this tournaments.</p>
        </div>
        @if(auth()->check() && auth()->user()->hasRole('Admin'))
            <a href="{{ route('approveRegistration') }}" wire:navigate
                class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Go to approving page
            </a>
        @endif
    </div>

    <div class="grid gap-6">
        @foreach ($approvedRegistrations as $registration)
            @if($registration->sport && $registration->sport->type == 'team')
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col">
                    <div class="px-6 py-5 border-b border-gray-50 bg-gradient-to-r from-indigo-50/50 to-white">
                        <div class="text-xs font-semibold text-indigo-600 mb-1 uppercase tracking-wider">{{ $registration->sport->name }}</div>
                        <h3 class="text-lg font-bold text-indigo-950">{{ $registration->groupName }}</h3>
                        <div class="mt-1 flex items-center text-xs font-medium text-gray-500">
                            <svg class="mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ is_array($registration->name) ? count($registration->name) : 0 }} Members
                        </div>
                    </div>
                    <div class="px-6 py-5 flex-1 bg-white">
                        <ul class="space-y-3">
                            @if(is_array($registration->name) || is_object($registration->name))
                                @foreach($registration->name as $member)
                                    <li class="flex items-center text-sm font-medium text-gray-700">
                                        <div
                                            class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold mr-3 border border-indigo-200 shadow-sm">
                                            {{ substr($member, 0, 1) }}
                                        </div>
                                        {{ $member }}
                                    </li>
                                @endforeach
                            @else
                                <li class="text-sm text-gray-500 italic">No members listed.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            @else
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col hover:shadow-md transition-shadow duration-300">
                    <div class="text-xs font-semibold text-emerald-600 mb-3 uppercase tracking-wider">{{ $registration->sport->name ?? 'Unknown Sport' }}</div>
                    <div class="flex items-center">
                        <div
                            class="h-12 w-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-lg font-bold shadow-sm">
                            {{ substr($registration->user->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">{{ $registration->user->name ?? 'Unknown' }}</h3>
                            <p class="text-sm text-gray-500">Approved Athlete</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>