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

    public function deleteRegistration(Registration $registration)
    {
        $registration->delete();
        $this->approvedRegistrations = Registration::where('status', 'approved')->get();
        session()->flash('success', 'Registration deleted successfully');
    }

    public function changeStatus(Registration $registration, $status)
    {
        $registration->status = $status;
        $registration->save();
        $this->approvedRegistrations = Registration::where('status', 'approved')->get();
        session()->flash('success', 'Registration status changed successfully');
    }
}
