<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MatchRecord;
use App\Models\MatchParticipant;
use App\Models\Registration;
use Livewire\Attributes\Url;

class AssignMatchParticipants extends Component
{
    public $matches = [];
    public $registrations = [];

    #[Url]
    public $title = '';

    public $selectedMatch;
    public $participant1;
    public $participant2;

    public function mount()
    {
        $this->matches = MatchRecord::doesntHave('participants')->get();
        $this->registrations = Registration::where('status', 'approved')
            ->whereNotNull('contingent_id')
            ->get();

        if ($this->title) {
            $match = MatchRecord::where('title', $this->title)->first();
            if ($match) {
                $this->selectedMatch = $match->id;
                $this->updatedSelectedMatch($match->id);
            }
        }
    }

    public function updatedSelectedMatch($value)
    {
        if ($value) {
            $match = MatchRecord::find($value);
            if ($match) {
                $this->registrations = Registration::where('sport_id', $match->sport_id)
                    ->where('status', 'approved')
                    ->whereNotNull('contingent_id')
                    ->get();
            } else {
                $this->registrations = Registration::where('status', 'approved')
                    ->whereNotNull('contingent_id')
                    ->get();
            }
        } else {
            $this->registrations = Registration::where('status', 'approved')
                ->whereNotNull('contingent_id')
                ->get();
        }
        $this->reset(['participant1', 'participant2']);
    }

    public function saveParticipant()
    {
        $this->validate([
            'selectedMatch' => 'required|exists:match_records,id',
            'participant1' => 'required|exists:registrations,id',
            'participant2' => 'required|exists:registrations,id|different:participant1',
        ]);

        $reg1 = Registration::find($this->participant1);
        $reg2 = Registration::find($this->participant2);

        if (!$reg1 || !$reg1->contingent_id) {
            $this->addError('participant1', 'This participant must be assigned to a contingent first.');
            return;
        }

        if (!$reg2 || !$reg2->contingent_id) {
            $this->addError('participant2', 'This participant must be assigned to a contingent first.');
            return;
        }

        // Delete existing participants for this match
        MatchParticipant::where('match_id', $this->selectedMatch)->delete();

        // Create new participants
        MatchParticipant::create([
            'match_id' => $this->selectedMatch,
            'user_id' => $reg1->user_id,
            'contingent_id' => $reg1->contingent_id,
            'score' => 0,
        ]);

        MatchParticipant::create([
            'match_id' => $this->selectedMatch,
            'user_id' => $reg2->user_id,
            'contingent_id' => $reg2->contingent_id,
            'score' => 0,
        ]);

        session()->flash('success', 'Match participants assigned successfully.');
        $this->reset(['participant1', 'participant2', 'selectedMatch', 'title']);
        $this->matches = MatchRecord::all();
        $this->registrations = Registration::where('status', 'approved')
            ->whereNotNull('contingent_id')
            ->get();
    }
    
    public function render()
    {
        return view('livewire.assign-match-participants');
    }
}
