<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <!-- Header & Navigation -->
    <div class="mb-8">
        <a href="{{ route('listSport') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 mb-4 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Sports List
        </a>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center">
            {{ $sport->name }}
            <span class="ml-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-bold tracking-wide uppercase {{ $sport->type === 'team' ? 'bg-indigo-100 text-indigo-800' : 'bg-emerald-100 text-emerald-800' }}">
                {{ ucfirst($sport->type) }}
            </span>
        </h2>
        <p class="mt-2 text-sm text-gray-500">List of approved {{ $sport->type === 'team' ? 'teams' : 'athletes' }} for this sport.</p>
    </div>

    @if($registrations->isEmpty())
        <div class="text-center bg-white rounded-2xl shadow-sm border border-gray-100 p-12 mt-8">
            <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="mt-4 text-lg font-semibold text-gray-900">No {{ $sport->type === 'team' ? 'teams' : 'athletes' }} found</h3>
            <p class="mt-2 text-sm text-gray-500">There are currently no approved registrations for this sport.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($registrations as $registration)
                @if($sport->type == 'team')
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col">
                        <div class="px-6 py-5 border-b border-gray-50 bg-gradient-to-r from-indigo-50/50 to-white">
                            <h3 class="text-lg font-bold text-indigo-950">{{ $registration->groupName }}</h3>
                            <div class="mt-1 flex items-center text-xs font-medium text-gray-500">
                                <svg class="mr-1.5 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ is_array($registration->name) ? count($registration->name) : 0 }} Members
                            </div>
                        </div>
                        <div class="px-6 py-5 flex-1 bg-white">
                            <ul class="space-y-3">
                                @if(is_array($registration->name) || is_object($registration->name))
                                    @foreach($registration->name as $member)
                                        <li class="flex items-center text-sm font-medium text-gray-700">
                                            <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-bold mr-3 border border-indigo-200 shadow-sm">
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
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center hover:shadow-md transition-shadow duration-300">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-lg font-bold shadow-sm">
                            {{ substr($registration->user->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">{{ $registration->user->name ?? 'Unknown' }}</h3>
                            <p class="text-sm text-gray-500">Approved Athlete</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
