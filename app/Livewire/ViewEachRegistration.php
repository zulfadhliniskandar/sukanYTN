<?php

namespace App\Livewire;

use App\Models\Registration;
use Livewire\Component;

class ViewEachRegistration extends Component
{
    public $registration;
    public $contingent_id;
    public function mount(Registration $registration) {
        $this->registration = $registration;
        $this->contingent_id = $registration->contingent_id;

    }
    public function render()
    {
        return view('livewire.view-each-registration');
    }
}
