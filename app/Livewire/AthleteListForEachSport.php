<?php

namespace App\Livewire;

use App\Models\Sport;
use Livewire\Component;

class AthleteListForEachSport extends Component
{
    public $sport;
    public $registrations = [];

    public function mount(Sport $sport)
    {
        $this->sport = $sport;
        $this->registrations = $sport->registrations()->where('status', 'approved')->get();
    }
    public function render()
    {
        return view('livewire.athlete-list-for-each-sport');
    }
}
