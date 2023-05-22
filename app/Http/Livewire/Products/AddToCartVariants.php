<?php

namespace App\Http\Livewire\Products;

use App\Models\Feature;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use WireUi\Traits\Actions;

class AddToCartVariants extends Component
{
    use Actions;

    public $product;
    public $qty = 0;

    public $selectedFeatures = [];

    public $instance = 'shopping';
    public $type = 'simple';

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
                'type' => $this->type,
                'features' => Feature::whereIn('id', $this->selectedFeatures)
                                    ->pluck('description', 'id')
                                    ->toArray()
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

        $this->notification()->success(
            $title = 'Producto agregado al carrito',
            $description = 'El producto se agregó al carrito con éxito.'
        );

    }

    public function render()
    {
        return view('livewire.products.add-to-cart-variants');
    }
}
