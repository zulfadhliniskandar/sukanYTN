<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MatchRecord;
use Livewire\Attributes\On;

class MatchList extends Component
{
    public $livescore = [];

    public function mount(){
        $matches = MatchRecord::with('participants')->get();
        foreach($matches as $match){
            foreach($match->participants as $participant){
                $this->livescore[$participant->id] = $participant->score;
            }
        }
    }

    #[On('echo:matches,ScoreUpdated')]
    public function updateScoreboard($event){
        $this->livescore[$event['participantId']] = $event['score'];
    }

    public function render()
    {
        return view('livewire.match-list', [
            'matches' => MatchRecord::with('participants.user')->get()
        ]);
    }
}
