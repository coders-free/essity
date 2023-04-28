<?php

namespace App\Http\Livewire\Admin\Variants;

use App\Models\Feature;
use Livewire\Component;

class Features extends Component
{

    public $variant, $features;
    public $name;

    protected $rules = [
        'features.*.name' => 'required|string',
    ];

    public function mount(){
        $this->getFeatures();
    }

    public function getFeatures(){
        $this->features = Feature::where('variant_id', $this->variant->id)->get();
    }

    public function store(){

        $this->validate([
            'name' => 'required|string'
        ]);

        $this->variant->features()->create([
            'name' => $this->name
        ]);

        $this->reset('name');

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
