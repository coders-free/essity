<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCart extends Component
{

    public $product;

    public $qty = 0;

    public function getItemProperty(){

        return [
            'id' => $this->product->id,
            'name' => $this->product->name, 
            'qty' => $this->qty, 
            'price' => 0,
            'options' => [
                'code' => $this->product->code,
                'line_id' => $this->product->category->line_id,
                'category_id' => $this->product->category_id,
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

        return redirect()->route('cart.index');

    }

    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
