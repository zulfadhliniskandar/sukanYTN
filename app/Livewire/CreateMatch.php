<?php

namespace App\Livewire;

use App\Models\MatchRecord;
use App\Models\Sport;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateMatch extends Component
{
    public $sports = [];
#[Validate('required|exists:sports,id')]
    public $sport='';
    #[Validate('required|string')]
    public $title='';
    public $status='scheduled';
    //#[Validate('required')]
    public $start_time=null;
    //#[Validate('required')]
    public $end_time=null;

    public function mount(){
        $this->sports = Sport::all();
        
    }

    public function render()
    {
        return view('livewire.create-match');
    }

    public function save(){
        $this->validate();
        MatchRecord::create([
            'sport_id' => $this->sport,
            'title' => $this->title,
            'status' => $this->status,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);
        session()->flash('success', 'Match added successfully');
        $this->reset();
        
    }
}
