<div class="p-6 bg-white rounded-lg shadow-sm">
    <h2 class="text-xl font-bold mb-4">{{ $match->title }}</h2>

    <div class="flex justify-between items-center bg-gray-50 p-6 rounded-xl border border-gray-100">
        @foreach($match->participants as $participant)
            <div class="text-center">
                <p class="text-sm text-gray-500 font-medium">{{ $participant->user->name }}</p>
                <div class="text-5xl font-extrabold text-blue-600 mt-2">
                    {{ $livescore[$participant->id] ?? $participant->score }}
                </div>
            </div>
            @if(!$loop->last)
                <div class="text-2xl font-bold text-gray-300">VS</div>
            @endif
        @endforeach
    </div>

    <div class="mt-4 flex justify-between items-center text-sm">
        <span class="px-3 py-1 rounded-full text-xs font-semibold 
            {{ $match->status === 'ongoing' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
            {{ ucfirst($match->status) }}
        </span>
        <span class="text-gray-400">Updated: {{ now()->format('H:i:s') }}</span>
    </div>
</div>