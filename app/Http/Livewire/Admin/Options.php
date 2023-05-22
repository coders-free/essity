<?php

namespace App\Http\Livewire\Admin;

use App\Enums\TypeOptions;
use App\Models\Feature;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Options extends Component
{
    public $options;

    public $new_option = [
        'name' => '',
        'type' => TypeOptions::Text->value
    ];

    public $fields = [
        [
            'value' => '',
            'description' => ''
        ]
    ];

    public $new_feature = [];

    public $openModal = false;

    //Ciclos de vida
    public function mount(){
        $this->getOptions();
    }

    public function updatedNewOptionType($value){
        foreach ($this->fields as &$field) {
            $field['value'] = '';
        }
    }

    public function getOptions(){
        $this->options = Option::with('features')->get();
    }

    public function add_new_field()
    {
        $this->fields[] = [
            'value' => '',
            'description' => ''
        ];
    }

    public function remove_field($index)
    {
        unset($this->fields[$index]);
    }

    public function addOption(){
        $this->validate([
            'new_option.name' => 'required|min:3|max:255',
            'new_option.type' => 'required|integer|in:1,2',
            'fields.*.value' => 'required|min:3|max:255',
            'fields.*.description' => 'required|min:3|max:255'
        ], [], [
            'new_option.name' => 'nombre',
            'new_option.type' => 'tipo',
            'fields.*.value' => 'valor',
            'fields.*.description' => 'descripción'
        ]);


        $option = Option::create($this->new_option);

        foreach ($this->fields as $field) {
            $option->features()->create($field);
        }

        $this->getOptions();

        $this->reset(['new_option', 'fields', 'openModal']);

    }

    public function removeOption(Option $option){

        if($option->features()->count() > 0){
            $this->emit('sweetAlert', 'error', 'Oops...', 'No se puede eliminar la opción porque tiene características asociadas');
            return;
        }

        $option->delete();
        $this->getOptions();
    }

    //Add new feature
    public function addFeature(Option $option){

        $this->validate([
            "new_feature.{$option->id}.value" => "required|min:3|max:255",
            "new_feature.{$option->id}.description" => "required|min:3|max:255"
        ],[],[
            "new_feature.{$option->id}.value" => 'valor',
            "new_feature.{$option->id}.description" => 'descripción'
        ]);

        $option->features()->create($this->new_feature[$option->id]);

        unset($this->new_feature[$option->id]);

        $this->getOptions();
    }

    public function removeFeature(Feature $feature){
        
        if (DB::table('feature_variant')->where('feature_id', $feature->id)->doesntExist()) {
            $feature->delete();
            $this->getOptions();

            return;
        }

        $this->emit('sweetAlert', 'error', 'Oops...', 'No se puede eliminar la característica porque tiene variantes asociadas');

    }

    public function render()
    {
        return view('livewire.admin.options');
    }
}
