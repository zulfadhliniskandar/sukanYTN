<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Venue;
use App\Models\User;

class AddVenue extends Component
{
    #[Validate("required|string|max:255")]
    public $name = '';
    #[Validate("required|numeric")]
    public $latitude = '';
    #[Validate("required|numeric")]
    public $longitude = '';
    #[Validate("nullable|string")]
    public $location_link = '';
    #[Validate("nullable|string")]
    public $description = '';
    public function render()
    {
        if(!auth()->check() || !auth()->user()->hasRole(['PIC', 'Admin'])){
            abort(404);
        }
        return view('livewire.add-venue');
    }

    public function save(){
        if(!auth()->check() || !auth()->user()->hasRole(['PIC', 'Admin'])){
            abort(404);
        }
        $this->validate();
        Venue::create([
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'location_link' => $this->location_link,
            'description' => $this->description,
        ]);
        session()->flash('success', 'Venue added successfully');
        $this->redirect('/dashboard', navigate: true);
        $this->reset();
    }
}
