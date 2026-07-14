<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Registration;
use App\Models\User;


class ApproveRegistration extends Component
{
    public $registrations = [];
    public $status = '';

    public function mount(Registration $registration)
    {
        if (!auth()->check()) {
            abort(404);
        }
        $this->registrations = Registration::where('status', 'pending')->get();
    }

    public function render()
    {
        return view('livewire.approve-registration');
    }

    public function updateStatus($newStatus, Registration $registration)
    {
        if (!auth()->check()) {
            abort(404);
        }
        
        $registration->update([
            'status' => $newStatus,
        ]);

        if ($newStatus === 'approved' && $registration->user_id) {
            $user = User::find($registration->user_id);
            if ($user) {
                $user->role = 'Athlete';
                $user->save();
            }
        }

        session()->flash('success', 'Registration status updated successfully');
        return redirect()->route('approveRegistration');
    }
}
