<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MatchRecord;
use Livewire\Attributes\On;

class OngoingMatch extends Component
{
    public $ongoingMatches = [];
    public $livescore = [];

    public function mount()
    {
        $this->loadMatches();
    }

    public function loadMatches()
    {
        $this->ongoingMatches = MatchRecord::with('participants.user')
            ->where('status', 'ongoing')
            ->get();

        foreach ($this->ongoingMatches as $match) {
            foreach ($match->participants as $participant) {
                $this->livescore[$participant->id] = $participant->score;
            }
        }
    }

    #[On('echo:matches,ScoreUpdated')]
    public function updateScoreboard($event)
    {
        $this->livescore[$event['participantId']] = $event['score'];
    }

    public function render()
    {
        return view('livewire.ongoing-match');
    }
}
