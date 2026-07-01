<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Sport;
use App\Models\User;   
use App\Models\Venue; 

class AddSports extends Component
{
    #[Validate('required|string|max:255', message: 'Name is required')]
    public $name = '';
    #[Validate('required|exists:venues,id', message: 'Valid venue is required')]
    public $venue = '';
    #[Validate('required|in:individual,team', message: 'Type is required')]
    public $type = '';
    public $venues = [];

    public function mount(){
        $this->venues = Venue::all();
    }

    public function render()
    {
        if(!auth()->check()|| !auth()->user()->hasRole(['Admin'])){
            abort(404);
        }

        return view('livewire.add-sports');
    }

    public function save(){
        if(!auth()->check()|| !auth()->user()->hasRole(['Admin'])){
            abort(404);
        }
        $this->validate();
        Sport::create([
            'name' => $this->name,
            'venue_id' => $this->venue,
            'type' => $this->type,
        ]);
        session()->flash('success', 'Sports added successfully');
        $this->reset();
        $this->redirect('/dashboard', navigate: true);
    }


}
