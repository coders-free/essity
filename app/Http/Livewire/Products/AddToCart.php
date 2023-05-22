<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use WireUi\Traits\Actions;

class AddToCart extends Component
{
    use Actions;

    public $product, $variant;

    public $qty = 0;

    public $instance = 'shopping';
    public $type = 'simple';

    public function mount()
    {
        $this->variant = $this->product->variants->first();
    }


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
                'type' => $this->type,
                'features' => []
            ],
            'tax' => 18,
        ];
    }

    public function add_to_cart()
    {
        
        Cart::instance($this->instance);

        Cart::add($this->item)
            ->associate(Product::class);

        Cart::store(auth()->id());

        /* return redirect()->route('orders.cart.index'); */
        $this->notification()->success(
            $title = 'Producto agregado al carrito',
            $description = 'El producto se agregó al carrito con éxito.'
        );

    }

    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
