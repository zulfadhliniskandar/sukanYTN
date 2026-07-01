<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Venue;
use Livewire\Attributes\Validate;

class EditVenue extends Component
{
    public Venue $venue;

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

    public function mount(Venue $venue){
        $this->venue = $venue;
        $this->name = $venue->name;
        $this->latitude = $venue->latitude;
        $this->longitude = $venue->longitude;
        $this->location_link = $venue->location_link;
        $this->description = $venue->description;
    }

    public function updateVenue()
    {
        $this->validate();
        $this->venue->update([
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'location_link' => $this->location_link,
            'description' => $this->description,
        ]);
        session()->flash('success', 'Venue updated successfully');
        $this->redirect(route('listVenue'), navigate: true);
    }   
    public function render()
    {
        return view('livewire.edit-venue');
    }
}
