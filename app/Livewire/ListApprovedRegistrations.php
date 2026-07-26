<?php

namespace App\Livewire;

use App\Models\PicSport;
use App\Models\Registration;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Sport;

class ListApprovedRegistrations extends Component
{
    public $sport;
    public $approvedRegistrations = [];

    #[Url(as: 'type')]
    public $selectedType = 'all';

    public function mount(Sport $sport)
    {
        if (!auth()->check() || !auth()->user()->hasRole(['Admin', 'PIC'])) {
            abort(404);
        }
        $this->sport = $sport;
        if (request()->has('type')) {
            $this->selectedType = request('type');
        }
        $this->loadRegistrations();
    }

    public function filter($type)
    {
        $this->selectedType = $type;
        $this->loadRegistrations();
    }

    public function loadRegistrations()
    {
        $query = Registration::where('status', 'approved')->with(['sport', 'contingent', 'user']);

        if (auth()->user()->hasRole('PIC') && !auth()->user()->hasRole('Admin')) {
            $picSportIds = PicSport::where('user_id', auth()->id())->pluck('sport_id');
            $query->whereIn('sport_id', $picSportIds);
        }

        if ($this->selectedType === 'team') {
            $query->whereHas('sport', function ($q) {
                $q->where('type', 'team');
            });
        } elseif ($this->selectedType === 'individual') {
            $query->whereHas('sport', function ($q) {
                $q->where('type', 'individual');
            });
        } elseif ($this->selectedType === 'no_contingent') {
            $query->whereNull('contingent_id');
        }

        $this->approvedRegistrations = $query->get();
    }

    public function render()
    {
        $baseQuery = Registration::where('status', 'approved');
        if (auth()->user()->hasRole('PIC') && !auth()->user()->hasRole('Admin')) {
            $picSportIds = PicSport::where('user_id', auth()->id())->pluck('sport_id');
            $baseQuery->whereIn('sport_id', $picSportIds);
        }

        $allCount = (clone $baseQuery)->count();
        $teamCount = (clone $baseQuery)->whereHas('sport', function ($q) {
            $q->where('type', 'team');
        })->count();
        $individualCount = (clone $baseQuery)->whereHas('sport', function ($q) {
            $q->where('type', 'individual');
        })->count();
        $noContingentCount = (clone $baseQuery)->whereNull('contingent_id')->count();

        return view('livewire.list-approved-registrations', [
            'counts' => [
                'all' => $allCount,
                'team' => $teamCount,
                'individual' => $individualCount,
                'no_contingent' => $noContingentCount,
            ]
        ]);
    }

    public function deleteRegistration(Registration $registration)
    {
        $registration->delete();
        $this->loadRegistrations();
        session()->flash('success', 'Registration deleted successfully');
    }

    public function changeStatus(Registration $registration, $status)
    {
        $registration->status = $status;
        $registration->save();
        $this->loadRegistrations();
        session()->flash('success', 'Registration status changed successfully');
    }
}
