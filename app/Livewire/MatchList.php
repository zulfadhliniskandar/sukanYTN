<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MatchRecord;
use Livewire\Attributes\On;

class MatchList extends Component
{
    public $livescore = [];
    public $selectedStatus = 'all';

    public function mount()
    {
        $this->loadScores();
    }

    public function loadScores()
    {
        $matches = MatchRecord::with('participants')->get();
        foreach ($matches as $match) {
            foreach ($match->participants as $participant) {
                $this->livescore[$participant->id] = $participant->score;
            }
        }
    }

    public function filter($status)
    {
        $this->selectedStatus = $status;
    }

    #[On('echo:matches,ScoreUpdated')]
    public function updateScoreboard($event)
    {
        $this->livescore[$event['participantId']] = $event['score'];
    }

    public function render()
    {
        $query = MatchRecord::with('participants.user');

        if ($this->selectedStatus && $this->selectedStatus !== 'all') {
            $query->where('status', $this->selectedStatus);
        }

        $allCount = MatchRecord::count();
        $scheduledCount = MatchRecord::where('status', 'scheduled')->count();
        $ongoingCount = MatchRecord::where('status', 'ongoing')->count();
        $finishedCount = MatchRecord::where('status', 'finished')->count();

        return view('livewire.match-list', [
            'matches' => $query->get(),
            'counts' => [
                'all' => $allCount,
                'scheduled' => $scheduledCount,
                'ongoing' => $ongoingCount,
                'finished' => $finishedCount,
            ]
        ]);


    }

    public function deleteMatch($id)
    {
        $match = MatchRecord::find($id);
        $match->delete();
        session()->flash('success', 'Match deleted successfully');
        return redirect()->route('listMatch');
    }
}
