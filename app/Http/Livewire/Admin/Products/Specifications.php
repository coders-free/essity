<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Specification;
use Livewire\Component;

class Specifications extends Component
{
    public $product;

    public $open = false;

    public $name;

    public function save(){
        $this->validate([
            'name' => 'required'
        ]);

        $this->product->specifications()->create([
            'name' => $this->name
        ]);

        $this->reset('name', 'open');
    }

    public function delete(Specification $specification){
        $specification->delete();
    }

    public function render()
    {
        return view('livewire.admin.products.specifications');
    }
}
