<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Registration;   
use App\Models\Contingent;   

class AddAthleteToContinget extends Component
{
    public $registration;

    #[Validate('required|exists:contingents,id')]
    public $contingent;

    public $contingents = [];

    public function mount(Registration $registration){
        if(!auth()->check() || !auth()->user()->hasRole(['Admin'])){
            abort(404);
        }
        $this->registration = $registration;
        $this->contingents = Contingent::all();
    }
    public function render()
    {
        if(!auth()->check() || !auth()->user()->hasRole(['Admin'])){
            abort(404);
        }
        return view('livewire.add-athlete-to-continget');
    }

    public function save(){
    if(!auth()->check() || !auth()->user()->hasRole(['Admin'])){
        abort(404);
    }
    $this->validate();
    $this->registration->contingent_id = $this->contingent;
    $this->registration->save();
    session()->flash('success', 'Athlete added to contingent successfully');
    $this->redirect(route('listApprovedRegistrations'), navigate: true);
    $this->reset();
    }
}
