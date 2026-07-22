<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\PicSport;
use App\Models\Sport;

class ListPIC extends Component
{
    public $sport;
    public $pics = [];

    public function mount(Sport $sport)
    {
        $this->sport = $sport;
        $this->pics = PicSport::where('sport_id', $sport->id)->with(['user', 'sport'])->get();
    }
    public function render()
    {
        if(!auth()->check() || !auth()->user()->hasRole(['Admin'])){
            abort(404);
        }
        return view('livewire.list-p-i-c');
    }

    public function deletePIC($picId)
    {
        $pic = PicSport::findOrFail($picId);
        if($pic){
            $pic->delete();
            $user = User::findOrFail($pic->user_id);
            $user->update([
                'role' => 'Normal User',
            ]);
            session()->flash('success', 'PIC deleted successfully');
        }else{
            session()->flash('error', 'PIC not found');
        }
        $this->redirect(route('listPIC', $this->sport), navigate:true);
    }
}
