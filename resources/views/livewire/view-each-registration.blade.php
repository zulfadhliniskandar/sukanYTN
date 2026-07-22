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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Registration Details
                    </span>
                    <h1 class="text-3xl font-black text-white tracking-tight">
                        @if($registration->sport->type == 'team')
                            {{ $registration->groupName ?? 'Team Registration' }}
                        @else
                            {{ is_array($registration->name) ? implode(', ', $registration->name) : $registration->name }}
                        @endif
                    </h1>
                    <p class="mt-2 text-indigo-100 text-sm max-w-xl">
                        Comprehensive overview of the registered participant(s) and their associated details.
                    </p>
                </div>
            </div>
        </div>

        <!-- Content Body -->
        <div class="px-8 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column: Core Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Sport Card -->
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 shadow-sm transition-all hover:shadow-md hover:border-indigo-100 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 -mt-2 -mr-2 w-16 h-16 bg-indigo-100/50 rounded-full blur-xl group-hover:bg-indigo-200/50 transition-colors"></div>
                        <div class="flex items-center mb-4 relative">
                            <div class="flex-shrink-0 bg-white rounded-xl p-3 mr-4 text-indigo-600 shadow-sm border border-slate-100 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Sport Category</h3>
                                <p class="text-lg font-bold text-slate-900">{{ $registration->sport->name ?? 'Unknown' }}</p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-slate-200/60 relative">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-slate-500">Type</span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-indigo-50 text-indigo-700 capitalize border border-indigo-100/50">
                                    {{ $registration->sport->type ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Contingent Card -->
                    <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 shadow-sm transition-all hover:shadow-md hover:border-fuchsia-100 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 -mt-2 -mr-2 w-16 h-16 bg-fuchsia-100/50 rounded-full blur-xl group-hover:bg-fuchsia-200/50 transition-colors"></div>
                        <div class="flex items-center relative">
                            <div class="flex-shrink-0 bg-white rounded-xl p-3 mr-4 text-fuchsia-600 shadow-sm border border-slate-100 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Contingent</h3>
                                <p class="text-lg font-bold text-slate-900">{{ $registration->contingent->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Participant Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl p-1 border border-slate-200 shadow-sm h-full">
                        <div class="bg-slate-50/50 rounded-xl p-6 h-full">
                            
                            @if ($registration->sport->type == 'team')
                                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-200">
                                    <div>
                                        <h3 class="text-lg font-bold text-slate-900">Team Roster</h3>
                                        <p class="text-sm text-slate-500 mt-1">List of all registered team members.</p>
                                    </div>
                                    <div class="bg-indigo-50 border border-indigo-100 rounded-xl px-5 py-2.5 text-center shadow-sm">
                                        <span class="block text-2xl font-black text-indigo-700 leading-none">
                                            {{ is_array($registration->name) ? count($registration->name) : 0 }}
                                        </span>
                                        <span class="block text-[10px] font-bold text-indigo-500 uppercase mt-1 tracking-wider">Members</span>
                                    </div>
                                </div>

                                @if(is_array($registration->name) && count($registration->name) > 0)
                                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        @foreach ($registration->name as $index => $member)
                                            <div x-data="{ openModal: false }" class="contents">
                                                <li class="bg-white rounded-xl p-4 border border-slate-200 shadow-sm flex items-center group hover:border-indigo-300 hover:shadow-md hover:ring-2 hover:ring-indigo-50 hover:ring-offset-1 transition-all duration-300 cursor-pointer" @click="openModal = true">
                                                    <div class="h-11 w-11 rounded-full bg-gradient-to-br from-indigo-50 to-violet-100 text-indigo-700 flex items-center justify-center text-sm font-bold mr-4 border border-indigo-100 shadow-inner flex-shrink-0 group-hover:from-indigo-500 group-hover:to-violet-600 group-hover:text-white transition-all duration-300">
                                                        {{ substr($member, 0, 1) }}
                                                    </div>
                                                    <div class="overflow-hidden">
                                                        <p class="text-sm font-bold text-slate-900 truncate group-hover:text-indigo-700 transition-colors">
                                                            {{ $member }}
                                                        </p>
                                                        <p class="text-[11px] font-medium text-slate-500 mt-0.5 uppercase tracking-wide">Participant #{{ $index + 1 }}</p>
                                                    </div>
                                                </li>

                                                <!-- Modal Window -->
                                                <div x-show="openModal" 
                                                     class="fixed inset-0 z-50 overflow-y-auto" 
                                                     x-cloak
                                                     style="display: none;">
                                                     
                                                    <!-- Backdrop with blur -->
                                                    <div x-show="openModal" 
                                                         x-transition:enter="ease-out duration-300"
                                                         x-transition:enter-start="opacity-0"
                                                         x-transition:enter-end="opacity-100"
                                                         x-transition:leave="ease-in duration-200"
                                                         x-transition:leave-start="opacity-100"
                                                         x-transition:leave-end="opacity-0"
                                                         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" 
                                                         @click="openModal = false"></div>

                                                    <!-- Center wrapper -->
                                                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                                                        <!-- Modal Content Card -->
                                                        <div x-show="openModal" 
                                                             x-transition:enter="ease-out duration-300"
                                                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                             x-transition:leave="ease-in duration-200"
                                                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                             class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-slate-100">
                                                             
                                                             <!-- Top Header Gradient -->
                                                             <div class="h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-600"></div>

                                                             <div class="px-6 pt-6 pb-6">
                                                                 <!-- Header -->
                                                                 <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                                                                     <h3 class="text-lg font-black text-slate-900 tracking-tight flex items-center gap-2">
                                                                         <span class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                                                                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                             </svg>
                                                                         </span>
                                                                         Member Details
                                                                     </h3>
                                                                     <button @click="openModal = false" class="text-slate-400 hover:text-slate-600 hover:bg-slate-50 p-2 rounded-xl transition-all duration-200">
                                                                         <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                                                         </svg>
                                                                     </button>
                                                                 </div>

                                                                 <!-- Content Fields -->
                                                                 <div class="mt-6 space-y-4">
                                                                     <!-- Name -->
                                                                     <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100 flex items-start gap-4">
                                                                         <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-650 text-white flex items-center justify-center text-lg font-black shadow-md shadow-indigo-100 flex-shrink-0">
                                                                             {{ substr($member, 0, 1) }}
                                                                         </div>
                                                                         <div>
                                                                             <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Full Name</span>
                                                                             <span class="block text-base font-extrabold text-slate-800 mt-0.5 leading-snug">{{ $member }}</span>
                                                                         </div>
                                                                     </div>

                                                                     <!-- Student ID -->
                                                                     <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100 flex items-start gap-4">
                                                                         <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 text-white flex items-center justify-center text-sm font-black shadow-md shadow-purple-100 flex-shrink-0">
                                                                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                                             </svg>
                                                                         </div>
                                                                         <div>
                                                                             <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Student ID / Matric No</span>
                                                                             <span class="block text-base font-mono font-bold text-indigo-600 mt-1 bg-indigo-50/60 px-3 py-1 rounded-lg border border-indigo-100/50 inline-block">
                                                                                 {{ $registration->student_id[$index] ?? 'N/A' }}
                                                                             </span>
                                                                         </div>
                                                                     </div>

                                                                     <!-- Designation -->
                                                                     <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100 flex items-start gap-4">
                                                                         <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-teal-500 to-emerald-500 text-white flex items-center justify-center text-sm font-black shadow-md shadow-teal-100 flex-shrink-0">
                                                                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                                             </svg>
                                                                         </div>
                                                                         <div>
                                                                             <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Role / Designation</span>
                                                                             <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black mt-1.5 {{ $index === 0 ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                                                                 {{ $index === 0 ? 'Team Captain' : 'Team Member' }}
                                                                             </span>
                                                                         </div>
                                                                     </div>
                                                                 </div>

                                                                 <!-- Footer Button -->
                                                                 <div class="mt-8 flex justify-end">
                                                                     <button @click="openModal = false" class="px-5 py-2.5 bg-slate-900 text-white hover:bg-slate-800 rounded-2xl text-sm font-bold shadow-md shadow-slate-200 hover:shadow-lg transition-all duration-200 w-full sm:w-auto">
                                                                         Done
                                                                     </button>
                                                                 </div>
                                                             </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </ul>
                                    
                                @else
                                    <div class="flex flex-col items-center justify-center py-12 text-center bg-white rounded-xl border border-dashed border-slate-300">
                                        <div class="bg-slate-50 rounded-full p-4 mb-3">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-slate-600 font-medium">No team members registered yet.</p>
                                    </div>
                                @endif

                            @else
                                <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-200">
                                    <div>
                                        <h3 class="text-lg font-bold text-slate-900">Athlete Information</h3>
                                        <p class="text-sm text-slate-500 mt-1">Individual participant details.</p>
                                    </div>
                                </div>

                                <div x-data="{ openModal: false }" class="contents">
                                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left cursor-pointer group hover:border-indigo-300 hover:shadow-md hover:ring-2 hover:ring-indigo-50 hover:ring-offset-1 transition-all duration-300 w-full" @click="openModal = true">
                                        <div class="h-20 w-20 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 text-white flex items-center justify-center text-3xl font-bold mb-4 sm:mb-0 sm:mr-6 shadow-lg shadow-indigo-200 flex-shrink-0 border-4 border-white ring-1 ring-slate-100 group-hover:scale-105 transition-transform duration-300">
                                            @php
                                                $athleteName = is_array($registration->name) ? implode(', ', $registration->name) : $registration->name;
                                            @endphp
                                            {{ substr($athleteName, 0, 1) ?? 'A' }}
                                        </div>
                                        <div class="pt-1">
                                            <h4 class="text-2xl font-black text-slate-900 mb-2 group-hover:text-indigo-700 transition-colors duration-300">
                                                {{ $athleteName }}
                                            </h4>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm">
                                                <svg class="mr-1.5 h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                Individual Athlete
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Modal Window -->
                                    <div x-show="openModal" 
                                         class="fixed inset-0 z-50 overflow-y-auto" 
                                         x-cloak
                                         style="display: none;">
                                         
                                        <!-- Backdrop with blur -->
                                        <div x-show="openModal" 
                                             x-transition:enter="ease-out duration-300"
                                             x-transition:enter-start="opacity-0"
                                             x-transition:enter-end="opacity-100"
                                             x-transition:leave="ease-in duration-200"
                                             x-transition:leave-start="opacity-100"
                                             x-transition:leave-end="opacity-0"
                                             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" 
                                             @click="openModal = false"></div>

                                        <!-- Center wrapper -->
                                        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                                            <!-- Modal Content Card -->
                                            <div x-show="openModal" 
                                                 x-transition:enter="ease-out duration-300"
                                                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                 x-transition:leave="ease-in duration-200"
                                                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                 class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-slate-100">
                                                 
                                                 <!-- Top Header Gradient -->
                                                 <div class="h-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-600"></div>

                                                 <div class="px-6 pt-6 pb-6">
                                                     <!-- Header -->
                                                     <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                                                         <h3 class="text-lg font-black text-slate-900 tracking-tight flex items-center gap-2">
                                                             <span class="p-2 bg-indigo-50 text-indigo-600 rounded-xl">
                                                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                 </svg>
                                                             </span>
                                                             Athlete Details
                                                         </h3>
                                                         <button @click="openModal = false" class="text-slate-400 hover:text-slate-600 hover:bg-slate-50 p-2 rounded-xl transition-all duration-200">
                                                             <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                                                             </svg>
                                                         </button>
                                                     </div>

                                                     <!-- Content Fields -->
                                                     <div class="mt-6 space-y-4">
                                                         <!-- Name -->
                                                         <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100 flex items-start gap-4">
                                                             <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-650 text-white flex items-center justify-center text-lg font-black shadow-md shadow-indigo-100 flex-shrink-0">
                                                                 {{ substr($athleteName, 0, 1) }}
                                                             </div>
                                                             <div>
                                                                 <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Full Name</span>
                                                                 <span class="block text-base font-extrabold text-slate-800 mt-0.5 leading-snug">{{ $athleteName }}</span>
                                                             </div>
                                                         </div>

                                                         <!-- Student ID -->
                                                         <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100 flex items-start gap-4">
                                                             <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 text-white flex items-center justify-center text-sm font-black shadow-md shadow-purple-100 flex-shrink-0">
                                                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                                 </svg>
                                                             </div>
                                                             <div>
                                                                 <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Student ID / Matric No</span>
                                                                 <span class="block text-base font-mono font-bold text-indigo-600 mt-1 bg-indigo-50/60 px-3 py-1 rounded-lg border border-indigo-100/50 inline-block">
                                                                     @if(is_array($registration->student_id) && isset($registration->student_id[0]))
                                                                         {{ $registration->student_id[0] }}
                                                                     @elseif(is_string($registration->student_id))
                                                                         {{ $registration->student_id }}
                                                                     @else
                                                                         N/A
                                                                     @endif
                                                                 </span>
                                                             </div>
                                                         </div>

                                                         <!-- Designation -->
                                                         <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100 flex items-start gap-4">
                                                             <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-teal-500 to-emerald-500 text-white flex items-center justify-center text-sm font-black shadow-md shadow-teal-100 flex-shrink-0">
                                                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                                 </svg>
                                                             </div>
                                                             <div>
                                                                 <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Role / Designation</span>
                                                                 <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-black mt-1.5 bg-indigo-50 text-indigo-700 border border-indigo-100">
                                                                     Individual Athlete
                                                                 </span>
                                                             </div>
                                                         </div>
                                                     </div>

                                                     <!-- Footer Button -->
                                                     <div class="mt-8 flex justify-end">
                                                         <button @click="openModal = false" class="px-5 py-2.5 bg-slate-900 text-white hover:bg-slate-800 rounded-2xl text-sm font-bold shadow-md shadow-slate-200 hover:shadow-lg transition-all duration-200 w-full sm:w-auto">
                                                             Done
                                                         </button>
                                                     </div>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>