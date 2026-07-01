<?php

namespace App\Livewire;
use App\Models\PicSport;
use App\Models\Sport;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\User;

class AssignPIC extends Component
{
    #[Validate('required')]
    public $sport_id='';

    #[Validate('required')]
    public Sport $sport;

    #[Validate('required')]
    public $users = [];
    
    #[Validate('required')]
    public $pic = '';
    
    public function mount(Sport $sport)
    {
        $this->sport = $sport;
        $this->sport_id = $sport->id;
        $this->users = User::where('role', 'Normal User')->get();
    }
    public function render()
    {
        return view('livewire.assign-p-i-c');
    }

    public function store(){
        $this->validate();

        // 1. Add into pic table (PicSport)
        PicSport::create([
            'sport_id' => $this->sport_id,
            'user_id' => $this->pic,
        ]);

        // 2. Change it in users table and set role to pic
        $user = User::find($this->pic);
        if ($user) {
            $user->role = 'PIC';
            $user->save();
        }

        session()->flash('success', 'PIC assigned successfully');
        $this->redirect('/dashboard', navigate: true);
    }
}
