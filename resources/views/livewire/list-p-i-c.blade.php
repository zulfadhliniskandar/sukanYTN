<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b border-gray-200 pb-5 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">PICs for {{ $sport->name }}</h1>
            <p class="mt-2 text-sm text-slate-500">Manage the Persons In Charge assigned to this sport.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('listSport') }}" wire:navigate
                class="inline-flex items-center justify-center px-4 py-2.5 bg-white text-slate-700 border border-slate-300 font-semibold rounded-lg shadow-sm hover:bg-slate-50 transition-all">
                Back
            </a>
            <a href="{{ route('assignPIC', $sport) }}" wire:navigate
                class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all whitespace-nowrap">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Assign PIC
            </a>
        </div>
    </div>

    <!-- PICs Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        @forelse ($pics as $pic)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow group flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center flex-shrink-0 font-bold text-lg">
                    {{ substr($pic->user->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-800 group-hover:text-blue-600 transition-colors">{{ $pic->user->name }}</h2>
                    <p class="text-sm text-slate-500 mt-1 flex items-center gap-1.5 break-all">
                        <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        {{ $pic->user->email }}
                    </p>
                    <div class="mt-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            PIC
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-slate-50 border border-slate-200 border-dashed rounded-2xl p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <h3 class="mt-2 text-sm font-semibold text-slate-900">No PICs assigned</h3>
                <p class="mt-1 text-sm text-slate-500">Get started by assigning a Person In Charge.</p>
                <div class="mt-6">
                    <a href="{{ route('assignPIC', $sport) }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Assign PIC
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>