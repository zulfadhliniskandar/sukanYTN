<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PicSport;
use App\Models\Sport;

class ListPIC extends Component
{
    public $sport;
    public $pics = [];

    public function mount(Sport $sport)
    {
        $this->sport = $sport;
        $this->pics = PicSport::where('sport_id', $sport->id)->with(['user', 'sport'])->get();
    }
    public function render()
    {
        return view('livewire.list-p-i-c');
    }
}
