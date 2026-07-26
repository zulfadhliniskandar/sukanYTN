<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MatchRecord;
use Livewire\Attributes\On;
use App\Models\PicSport;


use Livewire\Attributes\Url;

class MatchList extends Component
{
    public $livescore = [];

    #[Url(as: 'status')]
    public $selectedStatus = 'all';

    public function mount()
    {
        if (request()->has('status')) {
            $this->selectedStatus = request('status');
        }
        $this->loadScores();
    }

    public function loadScores()
    {
        $query = MatchRecord::with('participants');

        if (auth()->check() && auth()->user()->hasRole('PIC') && !auth()->user()->hasRole('Admin')) {
            $picSportIds = PicSport::where('user_id', auth()->id())->pluck('sport_id');
            $query->whereIn('sport_id', $picSportIds);
        }

        $matches = $query->get();
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
        $query = MatchRecord::with(['participants.user', 'sport']);
        $baseQuery = MatchRecord::query();

        if (auth()->check() && auth()->user()->hasRole('PIC') && !auth()->user()->hasRole('Admin')) {
            $picSportIds = PicSport::where('user_id', auth()->id())->pluck('sport_id');
            $query->whereIn('sport_id', $picSportIds);
            $baseQuery->whereIn('sport_id', $picSportIds);
        }

        $allCount = (clone $baseQuery)->count();
        $scheduledCount = (clone $baseQuery)->where('status', 'scheduled')->count();
        $ongoingCount = (clone $baseQuery)->where('status', 'ongoing')->count();
        $finishedCount = (clone $baseQuery)->where('status', 'finished')->count();
        $noParticipantCount = (clone $baseQuery)->doesntHave('participants')->count();

        if ($this->selectedStatus === 'no_participant') {
            $query->doesntHave('participants');
        } elseif ($this->selectedStatus && $this->selectedStatus !== 'all') {
            $query->where('status', $this->selectedStatus);
        }

        return view('livewire.match-list', [
            'matches' => $query->get(),
            'counts' => [
                'all' => $allCount,
                'scheduled' => $scheduledCount,
                'ongoing' => $ongoingCount,
                'finished' => $finishedCount,
                'no_participant' => $noParticipantCount,
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
