<?php

namespace App\Http\Livewire\Admin\Options;

use Livewire\Component;
use WireUi\Traits\Actions;

class Edit extends Component
{

    use Actions;

    public $option;

    public $attributeName;

    protected $rules = [
        'option.name' => 'required|string',
    ];
    

    public function save(){

        $this->validate();

        $this->option->save();

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
