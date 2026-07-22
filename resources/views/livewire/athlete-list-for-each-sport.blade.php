<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Decorative background blobs -->
    <div class="fixed top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute top-[-10%] left-[50%] w-96 h-96 bg-indigo-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-[20%] right-[-5%] w-72 h-72 bg-emerald-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Header & Navigation -->
    <div class="mb-8">
        <a href="{{ route('listSport') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-650 mb-4 transition-colors">
            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Sports List
        </a>
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight flex flex-wrap items-center gap-3">
                    {{ $sport->name }}
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold tracking-wide uppercase {{ $sport->type === 'team' ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-100' }}">
                        {{ ucfirst($sport->type) }}
                    </span>
                </h2>
                <p class="mt-2 text-sm text-slate-550 text-slate-500">List of approved {{ $sport->type === 'team' ? 'teams' : 'athletes' }} for this sport.</p>
            </div>
        </div>
    </div>

    @if($registrations->isEmpty())
        <div class="text-center py-20 bg-white/80 backdrop-blur rounded-3xl border border-dashed border-slate-300 shadow-sm">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 text-slate-400 mb-6 border border-slate-200">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-1">No {{ $sport->type === 'team' ? 'teams' : 'athletes' }} found</h3>
            <p class="text-slate-500 max-w-sm mx-auto">There are currently no approved registrations for this sport.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($registrations as $registration)
                @if($sport->type == 'team')
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl hover:border-indigo-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="px-6 py-6 border-b border-slate-100 bg-gradient-to-br from-indigo-50/80 to-white relative overflow-hidden">
                            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-100/50 rounded-full blur-xl group-hover:bg-indigo-200/50 transition-colors"></div>
                            <h3 class="text-2xl font-black text-slate-900 mb-1 truncate">{{ $registration->groupName }}</h3>
                            <div class="mt-1 flex items-center text-xs font-bold text-slate-400 uppercase tracking-wider">
                                <svg class="mr-1.5 h-4.5 w-4.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ is_array($registration->name) ? count($registration->name) : 0 }} Members
                            </div>
                        </div>
                        <div class="px-6 py-5 flex-1 bg-white">
                            <ul class="space-y-3">
                                @if(is_array($registration->name) || is_object($registration->name))
                                    @foreach($registration->name as $member)
                                        <li class="flex items-center text-sm font-semibold text-slate-700 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                            <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-100 to-indigo-50 text-indigo-700 flex items-center justify-center text-xs font-bold mr-3 border border-indigo-200 shadow-inner flex-shrink-0">
                                                {{ substr($member, 0, 1) }}
                                            </div>
                                            <span class="truncate">{{ $member }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-sm text-slate-505 text-slate-500 italic">No members listed.</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-lg shadow-slate-200/40 border border-slate-100 p-5 flex items-center hover:shadow-xl hover:border-emerald-250 hover:border-emerald-200 transition-all duration-300 transform hover:-translate-y-1 relative group">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-emerald-450 to-emerald-600 bg-gradient-to-br from-emerald-400 to-emerald-650 flex items-center justify-center text-white text-lg font-black shadow-sm flex-shrink-0">
                            {{ substr($registration->user->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="ml-4 overflow-hidden">
                            <h3 class="text-lg font-black text-slate-900 truncate group-hover:text-emerald-700 transition-colors">{{ $registration->user->name ?? 'Unknown' }}</h3>
                            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Approved Athlete</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
