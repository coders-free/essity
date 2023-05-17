<?php

namespace App\Http\Livewire\Admin\Options;

use App\Models\Feature;
use Livewire\Component;

class Features extends Component
{

    public $option, $features;
    public $value;

    protected $rules = [
        'features.*.value' => 'required|string',
    ];

    public function mount(){
        $this->getFeatures();
    }

    public function getFeatures(){
        $this->features = Feature::where('option_id', $this->option->id)->get();
        /* $this->features = Feature::all(); */
    }

    public function store(){

        $this->validate([
            'value' => 'required|string'
        ]);

        $this->option->features()->create([
            'value' => $this->value
        ]);

        $this->reset('value');

        $this->getFeatures();
    }

    public function update(){

        $this->validate();

        foreach ($this->features as $feature) {
            $feature->save();
        }

        $this->emit('saved');
    }

    public function destroy(Feature $feature){
     
        $feature->delete();

        $this->getFeatures();

    }

    public function render()
    {
        return view('livewire.admin.variants.features');
    }
}
