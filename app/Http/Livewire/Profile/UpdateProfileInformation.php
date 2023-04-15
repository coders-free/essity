<?php

namespace App\Http\Livewire\Profile;

use App\Models\Province;
use App\Models\Town;
use Livewire\Component;

class UpdateProfileInformation extends Component
{

    public $user, $profile;

    protected $rules = [
        'user.name' => 'required|string|max:255',
        'user.last_name' => 'required|string|max:255',
        'user.email' => 'required|string|email|max:255|unique:users',

        'profile.pharmacy_name' => 'required|string|max:255',
        'profile.address' => 'required|string|max:255',
        'profile.cp' => 'required|integer|digits_between:1,5',
        'profile.province_id' => 'required|integer|exists:provinces,id',
        'profile.town_id' => 'required|integer|exists:towns,id',
        'profile.phone' => 'required|string|max:255',
        'profile.nif_1' => ['required', 'string', 'max:9', 'regex:/^[0-9]{8}[A-Za-z]{1}$/'],
        'profile.nif_2' => ['required', 'string', 'max:9', 'regex:/^[0-9]{8}[A-Za-z]{1}$/'],
   
    ];

    public function mount(){
        $this->user = auth()->user();
        $this->profile = $this->user->profile;
    }

    public function updatedProfileProvinceId(){
        $this->profile->town_id = null;
    }

    public function updateProfileInformation(){

        $rules = $this->rules;

        $rules['user.email'] = 'required|string|email|max:255|unique:users,email,' . $this->user->id;

        $this->validate($rules);

        $this->user->save();
        $this->profile->save();

        $this->emit('saved');
    }


    public function render()
    {
        return view('livewire.profile.update-profile-information');
    }
}
