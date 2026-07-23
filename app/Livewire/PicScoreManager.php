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

        if ($this->match->participants()->count() === 0) {
            session()->flash('warning', 'No participants assigned to this match yet. Please assign participants first.');
            return redirect()->route('assignMatchParticipants', ['title' => $this->match->title]);
        }
    }

    private function ensureAuthorized()
    {
        if (!auth()->check()) {
            throw new \Exception("Access Denied");
        }
        if (auth()->user()->hasRole('Admin')) {
            return;
        }
        $isPicForSport = \App\Models\PicSport::where('user_id', auth()->id())
            ->where('sport_id', $this->match->sport_id)
            ->exists();
        
        if (!$isPicForSport) {
            throw new \Exception("Access Denied: You are not assigned to this sport.");
        }
    }

    public function incrementScore($participantId){
        $this->ensureAuthorized();

        $participant = $this->match->participants()->find($participantId);
        if ($participant) {
            $participant->increment('score');
            ScoreUpdated::dispatch($this->match->id, $participant->id, $participant->score);
        }
    }

    public function decrementScore($participantId){
        $this->ensureAuthorized();

        $participant = $this->match->participants()->find($participantId);
        if ($participant && $participant->score > 0) {
            $participant->decrement('score');
            ScoreUpdated::dispatch($this->match->id, $participant->id, $participant->score);
        }
    }

    public function updateStatus($status){
        $this->ensureAuthorized();

        $this->match->update(['status' => $status]);

        if($status === 'ongoing'){
        MatchRecord::where('id', $this->match->id)->update(['start_time' => now()]);
        }

        if($status === 'finished'){
        MatchRecord::where('id', $this->match->id)->update(['end_time' => now()]);
        }

        if   ($status === 'finished') {
            $participants = $this->match->participants;
            if ($participants->count() === 2) {
                $p1 = $participants[0];
                $p2 = $participants[1];

                if ($p1->score > $p2->score) {
                    $p1->update(['results' => 'win']);
                    $p2->update(['results' => 'lose']);
                } elseif ($p2->score > $p1->score) {
                    $p1->update(['results' => 'lose']);
                    $p2->update(['results' => 'win']);
                } else {
                    $p1->update(['results' => 'draw']);
                    $p2->update(['results' => 'draw']);
                }
            }
        }
    }
    
    public function render()
    {
        try {
            $this->ensureAuthorized();
        } catch (\Exception $e) {
            abort(403);
        }
        return view('livewire.pic-score-manager');
    }
}
