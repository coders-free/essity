<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class UsualCooperatives extends Component
{

    public $cooperatives;

    public $cooperative_id, $cooperative_number;

    public function save(){
        $this->validate([
            'cooperative_id' => 'required|integer|exists:cooperatives,id',
            'cooperative_number' => 'required|integer|digits_between:1,5',
        ], [], [
            'cooperative_id' => 'cooperativa',
            'cooperative_number' => 'número de cooperativa',
        ]);

        auth()->user()->cooperatives()->attach($this->cooperative_id, ['cooperative_number' => $this->cooperative_number]);

        $this->reset(['cooperative_id', 'cooperative_number']);

    }

    public function deleteCooperative($id){
        auth()->user()->cooperatives()->detach($id);
    }

    public function render()
    {
        return view('livewire.profile.usual-cooperatives');
    }
}
