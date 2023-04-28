<?php

namespace App\Http\Livewire\Admin\Variants;

use Livewire\Component;
use WireUi\Traits\Actions;

class Edit extends Component
{

    use Actions;

    public $variant;

    

    public $attributeName;

    protected $rules = [
        'variant.name' => 'required|string',
    ];
    

    public function save(){
        $this->validate();

        $this->variant->save();

        $this->notification()->success(
            $title = 'Variante actualizada con éxito',
            $description = 'La variante se actualizó con éxito.'
        );
    }

    

    public function render()
    {
        return view('livewire.admin.variants.edit');
    }
}
