<?php

namespace App\Livewire;

use Livewire\Component;
use Auth;
use App\Models\Registration;


class RegistrationStatus extends Component
{
    public $user;
    public $registrations = [];
    public function mount(){
        $this->user = Auth::user();
        $this->registrations = Registration::where('user_id', $this->user->id)->get();
        
    }
    public function render()
    {
        return view('livewire.registration-status');
    }
}
