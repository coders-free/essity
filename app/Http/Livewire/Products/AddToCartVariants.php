<?php

namespace App\Http\Livewire\Products;

use App\Models\Feature;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
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

            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);

        })->first();

        return $variant;
    }

    public function getItemProperty(){

        return [
            'id' => $this->product->id,
            'name' => $this->product->name, 
            'qty' => $this->qty, 
            'price' => 0,
            'options' => [
                'code' => $this->variant->code,
                'line_id' => $this->product->category->line_id,
                'category_id' => $this->product->category_id,
                'features' => Feature::whereIn('id', $this->selectedFeatures)
                                    ->pluck('description', 'id')
                                    ->toArray()
            ],
            'tax' => 18,
        ];
    }

    public function add_to_cart()
    {
        
        Cart::instance('shopping');

        Cart::add($this->item)
            ->associate(Product::class);

        Cart::store(auth()->id());

    }

    public function render()
    {
        return view('livewire.products.add-to-cart-variants');
    }
}
