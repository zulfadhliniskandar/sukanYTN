<?php

namespace App\Livewire;

use App\Models\Contingent;
use Livewire\Component;
use App\Models\Venue;
use Livewire\Attributes\Validate;

class EditContingent extends Component
{
    public Contingent $contingent;

    #[Validate("required|string|max:255")]
    public $name = '';

    public function mount(Contingent $contingent){
        $this->contingent = $contingent;
        $this->name = $contingent->name;
    }

    public function updateContingent()
    {
        if(!auth()->check() || !auth()->user()->hasRole(['PIC', 'Admin'])){
            abort(404);
        }
        $this->validate();
        $this->contingent->update([
            'name' => $this->name,
        ]);
        session()->flash('success', 'Contingent updated successfully');
        $this->redirect(route('listContingents'), navigate: true);
    }   
    public function render()
    {
        if(!auth()->check() || !auth()->user()->hasRole(['Admin'])){
            abort(404);
        }
        return view('livewire.edit-contingent');
    }
}
