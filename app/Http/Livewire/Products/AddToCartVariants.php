<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

class AddToCartVariants extends Component
{

    public $product, $variant;
    public $qty = 0;

    public function mount()
    {
        $this->variant = $this->product->variants->first();
    }

    public function render()
    {
        return view('livewire.products.add-to-cart-variants');
    }
}
