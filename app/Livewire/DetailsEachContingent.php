<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Registration;
use App\Models\Contingent;
class DetailsEachContingent extends Component
{
    public $contingent;
    public $registrations = [];
    public function mount(Contingent $contingent){
        $this->contingent = $contingent;
        $this->registrations = Registration::where('contingent_id', $contingent->id)->get();
    }
    public function render()
    {
        return view('livewire.details-each-contingent');
    }

    public function deleteRegistration($registrationId){
        $registration = Registration::find($registrationId);
        $registration->contingent_id = null;
        $registration->save();
        $this->redirect(route("detailsEachContingent", $this->contingent->id), navigate:true);
    }
}
