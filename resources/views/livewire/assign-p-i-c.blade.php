<div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50">
            <h2 class="text-xl font-bold text-slate-800">Assign PIC to {{ $sport->name }}</h2>
            <p class="text-sm text-slate-500 mt-1">Select a user to assign as the Person In Charge for this sport.</p>
        </div>

        <form wire:submit="store" class="p-6 space-y-6">
            <div>
                <label for="sport_id" class="block text-sm font-medium text-slate-700 mb-1">Sport</label>
                <input type="text" id="sport_id" name="sport_id" disabled value="{{ $sport->name }}"
                    class="w-full px-4 py-2.5 bg-slate-100 border border-slate-200 rounded-lg text-slate-500 cursor-not-allowed focus:ring-0">
            </div>

            <div>
                <label for="user_id" class="block text-sm font-medium text-slate-700 mb-1">PIC Name</label>
                <select id="user_id" name="user_id" wire:model="pic"
                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-lg text-slate-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow">
                    <option value="">Select a PIC...</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('pic') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('listPIC', $sport) }}" wire:navigate
                    class="px-5 py-2.5 text-slate-600 bg-white border border-slate-300 font-semibold rounded-lg shadow-sm hover:bg-slate-50 transition-all">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all">
                    Assign PIC
                </button>
            </div>
        </form>
    </div>
</div>