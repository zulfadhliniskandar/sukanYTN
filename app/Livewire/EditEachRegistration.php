<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Registration;

class EditEachRegistration extends Component
{
    public Registration $registration;
    public $groupName;
    public $names = [];
    public $isTeam = false;

    public function rules()
    {
        return [
            'groupName' => 'nullable|string|max:255',
            'names' => 'required|array',
            'names.*' => 'required|string',
        ];
    }

    public function mount(Registration $registration)
    {
        $this->registration = $registration;
        $this->isTeam = $registration->sport->type == 'team';
        
        $this->groupName = $registration->groupName;
        
        $nameData = $registration->name;
        $this->names = is_array($nameData) ? $nameData : (empty($nameData) ? [] : [$nameData]);
    }
    
    public function render()
    {
        return view('livewire.edit-each-registration');
    }

    public function removeAthlete($index){
        if (isset($this->names[$index])) {
            unset($this->names[$index]);
            $this->names = array_values($this->names);
        }
    }

    public function addAthlete()
    {
        $this->names[] = '';
    }

    public function updateRegistration()
    {
        $this->validate();
        
        $this->registration->groupName = $this->groupName;
        
        if ($this->isTeam) {
            $this->registration->name = $this->names;
        } else {
            // Store back as string for individuals if that is the convention
            $this->registration->name = $this->names[0] ?? '';
        }
        
        $this->registration->save();
        return $this->redirect(route('listApprovedRegistrations'), navigate: true);
        session()->flash('success', 'Registration updated successfully');
    }
}
