<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use App\Models\Variant;
use Livewire\Component;
use WireUi\Traits\Actions;

class Variants extends Component
{

    use Actions;
    
    public $product;
    public $openModal = false;

    public $options;
    public $option_id;

    public $fields = [
        [
            'id' => '',
            'value' => '',
            'description' => ''
        ]
    ];

    public $new_feature = [];

    public function mount()
    {
        $this->getOptions();
    }

    public function getFeaturesProperty(){
        return Feature::where('option_id', $this->option_id)->get();
    }

    public function getOptions(){
        $this->options = Option::get();
        $this->option_id = $this->options->first()->id;
    }

    public function getFeatures($option_id)
    {
        return Feature::where('option_id', $option_id)->get();
    }

    public function addField(){
        $this->fields[] = [
            'id' => '',
            'value' => ''
        ];
    }

    public function removeField($index){
        unset($this->fields[$index]);
    }

    public function field_change($index){

        $feature = Feature::find($this->fields[$index]['id']);

        if ($feature) {

            $this->fields[$index]['value'] = $feature->value;
            $this->fields[$index]['description'] = $feature->description;

        }else{
            $this->fields[$index]['value'] = '';
            $this->fields[$index]['description'] = '';
        }
    }

    public function addOption(){
        
        $this->validate([
            'fields.*.id' => 'required',
            'fields.*.value' => 'required',
        ],[],[
            'fields.*.id' => 'valor',
            'fields.*.value' => 'característica',
        ]);

        $this->product->options()->attach($this->option_id, [
            'features' => $this->fields
        ]);

        $this->reset(['fields', 'openModal']);

        $this->option_id = $this->options->first()->id;

    }

    public function addFeature($option_id){
            
        $this->validate([
            "new_feature.{$option_id}" => 'required|exists:features,id',
        ], [

        ], [
            "new_feature.{$option_id}" => 'valor',
        ]);

        
        $feature = Feature::find($this->new_feature[$option_id]);

        //Actualizar los valores de la tabla pivote
        $this->product->options()->updateExistingPivot($option_id, [
            'features' => array_merge($this->product->options->find($option_id)->pivot->features, [
                [
                    'id' => $feature->id,
                    'value' => $feature->value,
                    'description' => $feature->description
                ]
            ])
        ]);

        $this->new_feature[$option_id] = '';

    }


    public function generate_variant(){
        
        $combinaciones = [];
        $features = $this->product->options->pluck('pivot')->pluck('features');

        $this->generarCombinaciones($features, 0, [], $combinaciones);

        //Eliminar todas las variantes que tenga el producto
        $this->product->variants()->delete();

        foreach ($combinaciones as $combinacion) {
            $variant = Variant::create([
                'product_id' => $this->product->id,
            ]);

            $variant->features()->attach($combinacion);
        }

    }

    public function generarCombinaciones($colecciones, $index = 0, $combinacionActual = [], &$combinacionesFinales = [])
    {
        if ($index === count($colecciones)) {
            $combinacionesFinales[] = $combinacionActual;
            return;
        }

        foreach ($colecciones[$index] as $item) {
            $nuevaCombinacion = array_merge($combinacionActual, [$item->id]); // Corrección aquí
            $this->generarCombinaciones($colecciones, $index + 1, $nuevaCombinacion, $combinacionesFinales);
        }
    }


    public function render()
    {
        return view('livewire.admin.products.variants');
    }
}
