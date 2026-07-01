<?php

namespace App\Livewire;

use App\Models\Venue;
use Livewire\Component;
use App\Models\Sport;
use Livewire\Attributes\Validate;

class EditSport extends Component
{
    public Sport $sport;

    #[Validate("required|string|max:255")]
    public $name = '';
    #[Validate("required|in:team,individual")]
    public $type = '';
    #[Validate('required|exists:venues,id')]
    public $venue_id = '';
    public $venues=[];

    public function mount(Sport $sport, Venue $venue){
        $this->venues = $venue->all();
        $this->sport = $sport;
        $this->name = $sport->name;
        $this->type = $sport->type;
        $this->venue_id = $sport->venue_id;
    }

    public function updateSport(){
        $this->validate();
        $this->sport->update([
            'name' => $this->name,
            'type' => $this->type,
            'venue_id' => $this->venue_id,
        ]);
        session()->flash('success', 'Sport updated successfully');
        $this->redirect(route('listSport'), navigate:true);
    }   
    public function render()
    {
        return view('livewire.edit-sport');
    }
}
