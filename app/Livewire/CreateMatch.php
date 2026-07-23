<?php

namespace App\Livewire;

use App\Models\MatchRecord;
use App\Models\Sport;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateMatch extends Component
{
    public $sports = [];

    #[Validate('required|exists:sports,id')]
    public $sport = '';

    #[Validate('required|string|max:255')]
    public $title = '';

    public $status = 'scheduled';
    public $start_time = null;
    public $end_time = null;

    public $showAssignModal = false;
    public $createdMatchTitle = '';

    public function mount()
    {
        $this->sports = Sport::all();
    }

    public function render()
    {
        if (!auth()->check() || !auth()->user()->hasRole(['PIC', 'Admin'])) {
            abort(404);
        }
        return view('livewire.create-match');
    }

    public function save()
    {
        if (!auth()->check() || !auth()->user()->hasRole(['PIC', 'Admin'])) {
            abort(404);
        }

        $this->validate();

        $match = MatchRecord::create([
            'sport_id' => $this->sport,
            'title' => $this->title,
            'status' => $this->status,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        $this->createdMatchTitle = $match->title;
        $this->showAssignModal = true;
    }

    public function assignNow()
    {
        return redirect()->route('assignMatchParticipants', ['title' => $this->createdMatchTitle]);
    }

    public function assignLater()
    {
        session()->flash('success', 'Match added successfully');
        return redirect()->route('listMatch');
    }
}
