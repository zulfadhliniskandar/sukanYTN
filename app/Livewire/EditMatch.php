<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MatchRecord;
use App\Models\Sport;
use Illuminate\Support\Carbon;

class EditMatch extends Component
{
    public $match;
    public $title;
    public $sport_id;
    public $status;
    public $start_time;
    public $end_time;

    public function mount(MatchRecord $match)
    {
        $this->match = $match;
        $this->title = $match->title;
        $this->sport_id = $match->sport_id;
        $this->status = $match->status;
        $this->start_time = $match->start_time ? Carbon::parse($match->start_time)->format('Y-m-d\TH:i') : null;
        $this->end_time = $match->end_time ? Carbon::parse($match->end_time)->format('Y-m-d\TH:i') : null;
    }

    public function updateMatch()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'sport_id' => 'required|exists:sports,id',
            'status' => 'required|in:scheduled,ongoing,finished',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
        ]);

        $this->match->update([
            'title' => $this->title,
            'sport_id' => $this->sport_id,
            'status' => $this->status,
            'start_time' => $this->start_time ? Carbon::parse($this->start_time) : null,
            'end_time' => $this->end_time ? Carbon::parse($this->end_time) : null,
        ]);

        session()->flash('success', 'Match updated successfully.');
        return redirect()->route('listMatch');
    }

    public function render()
    {
        return view('livewire.edit-match', [
            'sports' => Sport::all(),
        ]);
    }
}
