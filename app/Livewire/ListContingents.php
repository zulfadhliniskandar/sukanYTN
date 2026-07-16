<?php

namespace App\Livewire;

use App\Models\Contingent;
use Livewire\Component;

class ListContingents extends Component
{
    public $contingents = [];
    public function mount(){
        $this->contingents = Contingent::all();
    }

    public function render()
    {
        return view('livewire.list-contingents');
    }

    public function deleteContingent($contingentId){
        $contingent = Contingent::find($contingentId);
        $contingent->delete();
        $this->redirect(route("listContingents"), navigate:true);
    }
}
