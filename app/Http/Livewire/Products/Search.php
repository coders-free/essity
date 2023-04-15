<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

class Search extends Component
{

    public $product_id;

    public function redirect2()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        return redirect()->route('products.show', $this->product_id);
    }

    public function render()
    {
        return view('livewire.products.search');
    }
}
