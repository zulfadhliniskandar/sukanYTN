<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Registration;


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

    public function updateStatus($status, Registration $registration)
    {
        if (!auth()->check()) {
            abort(404);
        }
        $status = $registration->update([
            'status' => $status,
        ]);
        session()->flash('success', 'Registration status updated successfully');
        return redirect()->route('approveRegistration');
    }
}
