<?php

namespace App\Livewire;

use App\Models\Venue;
use Livewire\Component;

class ListAvailableVenue extends Component
{
    public $venues = [];
    public function mount(){
        $this->venues = Venue::with('sports')->get();
    }

    public function render()
    {
        return view('livewire.list-available-venue');
    }

    public function deleteVenue($venueId){
        $venue = Venue::find($venueId);
        $venue->delete();
        $this->redirect(route("listVenue"), navigate:true);
    }
}
