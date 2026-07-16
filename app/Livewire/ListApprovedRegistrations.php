<?php

namespace App\Livewire;

use App\Models\Registration;
use Livewire\Component;
use App\Models\Sport;

class ListApprovedRegistrations extends Component
{
    public $sport;
    public $approvedRegistrations = [];

    public function mount(Sport $sport){
        
        if(!auth()->check() || !auth()->user()->hasRole(['Admin'])){
            abort(404);
        }
        $this->sport = $sport;
        $this->approvedRegistrations = Registration::where('status', 'approved')->get();
    }

    public function render()
    {
        return view('livewire.list-approved-registrations');
    }
}
