<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
class AiChatbot extends Component
{
    public bool $isOpen = false;
    public string $userMessage = '';
    public array $messages = [];

    public function mount(){
        if (session()->has('chatbot_messages')) {
            $this->messages = session('chatbot_messages');
        } else {
            $this->messages = [
                [
                    'role' => 'assistant', 
                    'content' => "Hello! I am your TSYTN Chatbot. How can I help you today?"
                ]
            ];
        }
    }
    
    public function toggleChat(){
        $this->isOpen = !$this->isOpen;
    }

    public function clearChat(){
        session()->forget('chatbot_messages');
        $this->messages = [
            [
                'role' => 'assistant', 
                'content' => "Hello! I am your TSYTN Chatbot. How can I help you today?"
            ]
        ];
    }

    public function sendMessage(){
        $this->validate([
            'userMessage' => 'required|string|max:500',
        ]);

        $this->messages[] = [
            'role' => 'user',
            'content' => $this->userMessage,
        ];

        session(['chatbot_messages' => $this->messages]);

        $prompt = $this->userMessage;
        $this->userMessage = '';
        
        $systemPrompt = [
            'role' => 'system',
            'content' => $this->getSystemPromptContent()
        ];
        $payloadMessages = array_merge([$systemPrompt], $this->messages);
        try {
        $response = Http::timeout(60)->post('http://localhost:11434/api/chat', [
            'model' => 'llama3.2',
            'messages' => $payloadMessages,
            'stream' => false,
        ]);

        if ($response->successful()) {
            $aiReply = $response->json('message.content');
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $aiReply,
            ];
            session(['chatbot_messages' => $this->messages]);
        }else{
            $this->messages[] = [
                'role' => 'assistant',
                'content' => "Sorry, I'm having trouble connecting to the AI. Please try again later."
            ];
        }
    }catch (\Exception $e){
        $this->messages[] = [
            'role' => 'assistant',
            'content' => "Sorry, there was an error connecting to the AI. Please try again later.",
        ];
    }
    }

    private function getSystemPromptContent(): string
    {
        $roleName = 'Public / Guest';
        $allowedPages = "- Public Pages:\n"
            . "  * Welcome Page: " . url('/') . "\n";
            

        if (auth()->check()) {
            $user = auth()->user();

            if ($user->hasRole('Admin')) {
                $roleName = 'Admin';
                $allowedPages .= "- Admin Management Pages:\n"
                    . "  * Approve Registrations: " . url('/approveRegistration') . "\n"
                    . "  * Create Match: " . url('/creatematch') . "\n"
                    . "  * Add Venue: " . url('/addvenue') . "\n"
                    . "  * Create Sports: " . url('/createsport') . "\n"
                    . "  * Add Contingent: " . url('/addContingent') . "\n"
                    . "  * List Contingents: " . url('/listcontingents') . "\n"
                    . "  * Assign Match Participants: " . url('/assignMatchParticipants') . "\n";
            } elseif ($user->hasRole('PIC')) {
                $roleName = 'PIC (Person In Charge)';
                $allowedPages .= "- PIC Management Pages:\n"
                    . "  * Approve Registrations for assigned sport: " . url('/approveRegistration') . "\n"
                    . "  * Create Match for assigned sport: " . url('/creatematch') . "\n"
                    . "  * Matches without participants: " . url('/scores?status=no_participant') . "\n";
            } elseif ($user->hasRole('Athlete')) {
                $roleName = 'Athlete';
                $allowedPages .= "- Athlete Pages:\n"
                    . "  * Registration Status: " . url('/registrationStatus') . "\n";
            }
        }

        return "ABOUT THE APP:
- Sukan YTN is a tournament management and live score tracking platform for YTN sports events.

CURRENT USER ROLE: {$roleName}

PERMITTED PAGES & FEATURES FOR THIS USER:
{$allowedPages}

STRICT SECURITY RULES FOR THE AI:
1. ONLY reveal or recommend URLs and features listed under 'PERMITTED PAGES & FEATURES FOR THIS USER'.
2. NEVER mention, reveal, or leak any administrative or management URLs (such as approveRegistration, creatematch, addvenue, createsport, etc.) to Public, Guest, or unauthorized users.
3. When recommending pages or URLs, ALWAYS format them as Markdown links like [Page Title](URL) (e.g. [Live Scores](http://sukan-ytn.test/scores)).
4. Be friendly, professional, and concise.
5. Reply in the same language as the user (English or Bahasa Melayu).
6. Only answer questions related to Sukan YTN, sports, match schedules, and platform navigation.";
    }

    public function render()
    {
        return view('livewire.ai-chatbot');
    }
}
