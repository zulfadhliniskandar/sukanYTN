<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sport;
use Livewire\Attributes\Validate;
use App\Models\Registration;
use App\Models\User;

class RegisterSport extends Component
{
    public $groupName = '';

    protected function rules()
    {
        return [
            'groupName' => $this->sportType === 'team' ? 'required|string|unique:registrations,groupName|max:255' : 'nullable|string|max:255',
            'sport_id' => 'required',
            'name' => 'required|array|min:1',
            'name.*' => 'required|string|max:255',
            'student_id' => 'required|array|min:1',
            'student_id.*' => 'required|string|max:255',
        ];
    }
    public $name = [];

    public $student_id = [];
    public $status = 'pending';
    public $user_id;
    public $sports = [];
    public $sport_id = '';
    public $sportType = '';

    public function mount($sport_id = null)
    {
        $this->sports = Sport::all();
        $this->user_id = auth()->user()->id;
        
        // Initialize with one empty member
        $this->name = [''];
        $this->student_id = [''];

        if ($sport_id) {
            $this->sport_id = $sport_id;
            $this->updatedSportId($sport_id);
        }
    }

    public function updatedSportId($value)
    {
        if (!auth()->check()){
            abort(404);
        }
        if ($value) {
            $sport = Sport::find($value);
            $this->sportType = $sport ? $sport->type : '';
        } else {
            $this->sportType = '';
        }
        
        // Reset members to just one when sport changes
        $this->name = [''];
        $this->student_id = [''];
        $this->groupName = '';
    }

    public function addMember()
    {
        if (!auth()->check()){
            abort(404);
        }
        $this->name[] = '';
        $this->student_id[] = '';
    }

    public function removeMember($index)
    {
        if (!auth()->check()){
            abort(404);
        }
        unset($this->name[$index]);
        unset($this->student_id[$index]);
        $this->name = array_values($this->name);
        $this->student_id = array_values($this->student_id);
    }

    public function render()
    {
        if(!auth()->check()){
            abort(404);
        }
        return view('livewire.register-sport');
    }

    public function store(){
        if(!auth()->check()){
            abort(404);
        }
        $this->validate();
        Registration::create([
            'groupName' => $this->groupName,
            'name' => $this->name,
            'student_id' => $this->student_id,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'sport_id' => $this->sport_id,
        ]);
        $this->reset();
        session()->flash('success', 'You have successfully registered for the sport');
        $this->redirect('/listSport');
    }
}
