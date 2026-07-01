<div class="p-6 bg-white rounded-lg shadow-md border border-blue-100">
    <h2 class="text-lg font-bold text-gray-800 mb-4">Manage Match: {{ $match->title }}</h2>

    <div class="space-y-4">
        @foreach($match->participants as $participant)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <span class="font-semibold">{{ $participant->user->name }}</span>
                <div class="flex items-center gap-3">
                    <button {{ $match->status !== 'ongoing' ? 'disabled' : '' }}
                        wire:click="decrementScore({{ $participant->id }})"
                        class="px-3 py-1 bg-white border border-gray-300 rounded hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">-</button>

                    <span class="w-12 text-center font-bold text-xl">{{ $participant->score }}</span>

                    <button {{ $match->status !== 'ongoing' ? 'disabled' : '' }}
                        wire:click="incrementScore({{ $participant->id }})"
                        class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">+</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 pt-4 border-t flex gap-2">
        <button {{ $match->status !== 'ongoing' ? 'disabled' : '' }} wire:confirm="Are you sure to end this match?"
            wire:click="updateStatus('finished')"
            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed">
            End Match
        </button>
    </div>
</div>