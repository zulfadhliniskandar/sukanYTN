<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Contingent;
use App\Models\User;

class AddContingent extends Component
{
    #[Validate("required|string|max:255")]
    public $name = '';
    public function render()
    {
        if(!auth()->check() || !auth()->user()->hasRole(['Admin'])){
            abort(404);
        }
        return view('livewire.add-contingent');
    }

    public function save(){
        if(!auth()->check() || !auth()->user()->hasRole(['Admin'])){
            abort(404);
        }
        $this->validate();
        Contingent::create([
            'name' => $this->name,
        ]);
        session()->flash('success', 'Contingent added successfully');
        $this->redirect('/dashboard', navigate: true);
        $this->reset();
    }
}
