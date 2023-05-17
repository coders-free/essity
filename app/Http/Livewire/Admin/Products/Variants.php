<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use WireUi\Traits\Actions;

class Variants extends Component
{

    use Actions;
    
    public $product;

    public $open = false;

    public $options;

    public $code;
    public $features = [];

    public function mount(){
        $this->options = $this->product->category->line->options;

        foreach ($this->options as $option) {
            $this->features[$option->id] = "";
        }
    }

    public function save(){

        $this->validate([
            'code' => 'required|unique:variants,code|unique:products,code',
            'features' => 'required|array',
            'features.*' => 'required|exists:features,id',
        ], [
            'features.*.required' => 'Debe seleccionar al menos una opción',
        ]);

        $variant = $this->product->variants()->create([
            'code' => $this->code,
        ]);

        $variant->features()->sync($this->features);

        foreach ($this->options as $option) {
            $this->features[$option->id] = "";
        }

        $this->reset(['code', 'open']);

        $this->notification()->success(
            $title = 'Variante creada',
            $description = 'La variante se creó con éxito.'
        );

    }

    public function render()
    {
        return view('livewire.admin.products.variants');
    }
}
