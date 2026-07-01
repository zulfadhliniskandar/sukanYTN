<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MatchRecord;
use Livewire\Attributes\On;

class PublicScoreboard extends Component
{
    public MatchRecord $match;
    public $livescore = [];
    public function mount(MatchRecord $match){
        $this->match = $match;
        foreach($match->participants as $participant){
            $this->livescore[$participant->id] = $participant->score;
        }
    }
    #[On('echo:matches.{match.id},ScoreUpdated')]
    public function updateScoreboard($event){
        $this->livescore[$event['participantId']] = $event['score'];
    }
    public function render()
    {
        return view('livewire.public-scoreboard');
    }
}
