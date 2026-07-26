<div>
    <!-- Floating Toggle Button (Bottom Right) -->
    <button wire:click="toggleChat"
        class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-2xl flex items-center justify-center transition-all transform hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <!-- Chat Window Modal -->
    @if($isOpen)
        <div
            class="fixed bottom-24 right-6 z-50 w-80 sm:w-96 bg-white rounded-2xl shadow-2xl border border-slate-200 flex flex-col overflow-hidden transition-all">

            <!-- Header -->
            <div class="bg-blue-600 p-4 text-white flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('icons/logotsytn.png') }}" class="w-6 h-6 object-contain" alt="Logo">
                    <h3 class="font-bold text-sm">Sukan YTN AI Assistant</h3>
                </div>
                <div class="flex items-center gap-3">
                    <button wire:click="clearChat" title="Clear Chat History" class="text-xs bg-white/20 hover:bg-white/30 text-white px-2 py-1 rounded-md transition-all">Clear</button>
                    <button wire:click="toggleChat" class="text-white/80 hover:text-white font-bold text-lg">&times;</button>
                </div>
            </div>

            <!-- Messages Stream -->
            <div class="p-4 h-80 overflow-y-auto space-y-3 bg-slate-50 text-sm">
                @foreach($messages as $msg)
                    @if(is_array($msg))
                        <div class="flex {{ ($msg['role'] ?? '') === 'user' ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[85%] px-4 py-2.5 rounded-2xl shadow-sm {{ ($msg['role'] ?? '') === 'user' ? 'bg-blue-600 text-white rounded-br-none' : 'bg-white text-slate-800 border border-slate-200 rounded-bl-none' }}">
                                <div class="chat-content text-sm {{ ($msg['role'] ?? '') === 'user' ? 'text-white [&_a]:text-blue-100' : 'text-slate-800 [&_a]:text-blue-600' }} [&_a]:underline [&_a]:font-bold hover:[&_a]:opacity-80 [&_p]:m-0 [&_p]:inline">
                                    {!! \Illuminate\Support\Str::markdown($msg['content'] ?? '') !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <!-- Typing indicator -->
                <div wire:loading wire:target="sendMessage" class="flex justify-start">
                    <div
                        class="bg-white px-4 py-2 rounded-2xl border border-slate-200 text-slate-400 text-xs animate-pulse">
                        Sukan YTN AI is thinking...
                    </div>
                </div>
            </div>

            <!-- Input Box -->
            <form wire:submit.prevent="sendMessage" class="p-3 bg-white border-t border-slate-200 flex gap-2">
                <input wire:model="userMessage" type="text" placeholder="Ask anything about Sukan YTN..."
                    class="flex-1 px-3 py-2 text-sm border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600" />
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition-all">
                    Send
                </button>
            </form>
        </div>
    @endif
</div>