<?php

namespace App\Livewire;

use Livewire\Component;
use App\Events\ScoreUpdated;
use App\Models\MatchRecord;
use App\Models\MatchParticipant;

class PicScoreManager extends Component
{
    public MatchRecord $match;

    public function mount(MatchRecord $match){
        $this->match = $match;
    }

    public function incrementScore($participantId){
        if(auth()->check() && !auth()->user()->hasRole(["PIC", "Admin"])){
            throw new \Exception("Access Denied");
        }

        $participant = $this->match->participants()->find($participantId);
        if ($participant) {
            $participant->increment('score');
            ScoreUpdated::dispatch($this->match->id, $participant->id, $participant->score);
        }
    }

    public function decrementScore($participantId){
        if(auth()->check() && !auth()->user()->hasRole(["PIC", "Admin"])){
            throw new \Exception("Access Denied");
        }

        $participant = $this->match->participants()->find($participantId);
        if ($participant && $participant->score > 0) {
            $participant->decrement('score');
            ScoreUpdated::dispatch($this->match->id, $participant->id, $participant->score);
        }
    }

    public function updateStatus($status){
        if(auth()->check() && !auth()->user()->hasRole(["PIC", "Admin"])){
            throw new \Exception("Access Denied");
        }

        $this->match->update(['status' => $status]);
    }
    
    public function render()
    {
        if(!auth()->check() || !auth()->user()->hasRole(['PIC', 'Admin'])){
            abort(404);
        }
        return view('livewire.pic-score-manager');
    }
}
