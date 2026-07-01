<?php

namespace App\Livewire;

use App\Models\Sport;
use Livewire\Component;

class AvailabelSports extends Component
{
    public $sports = [];
    public function mount(){
        $this->sports = Sport::with('venue')->get();
    }
    public function render()
    {
        return view('livewire.availabel-sports');
    }

    #[On('deleteSport')]
    public function deleteSport($id){
        $sport = Sport::findOrFail($id);
        $sport->delete();
        $this->redirect(route('listSport'), navigate:true);
    }
}
