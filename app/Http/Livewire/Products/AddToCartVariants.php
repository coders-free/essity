<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

class AddToCartVariants extends Component
{

    public $product;
    public $qty = 0;

    public $selectedFeatures = [];

    public function mount()
    {
    
        foreach ($this->product->options as $option) {

            $features = collect($option->pivot->features);
            $this->selectedFeatures[$option->id] = $features->first()->id;

        }
    }


    public function getVariantProperty()
    {

        $variant = $this->product->variants->filter(function ($variant) {

            /* return array_values($variant->features->pluck('id')->sort()) == collect($this->selectedFeatures)->sort(); */

            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);


        })->first();

        return $variant;
    }

    public function render()
    {
        return view('livewire.products.add-to-cart-variants');
    }
}
