<?php

namespace App\Http\Livewire\Admin\Clusters;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Line;
use Livewire\Component;

class Discounts extends Component
{

    public $cluster;
    public $open = false;

    public $discount_category = false;

    public $lines, $line_id = "";
    public $category_id = "";

    public $fields = [
        [
            'quantity' => '',
            'discount' => ''
        ]
    ];

    public function mount(){
        $this->lines = Line::all();
        $this->line_id = $this->lines->first()->id;
    }

    public function updatedLineId($value)
    {
        $this->category_id = "";
    }

    public function getCategoriesProperty()
    {
        return Category::where('line_id', $this->line_id)->get();
    }

    //Métodos
    public function addField()
    {
        $this->fields[] = [
            'quantity' => '',
            'discount' => ''
        ];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
    }

    public function addDiscount(){

        $this->validate([
            'fields.*.quantity' => 'required|numeric',
            'fields.*.discount' => 'required|numeric',
        ]);

        //Reordenar el array por cantidad
        $fields = collect($this->fields)->sortBy('quantity')->toArray();

        Discount::create([
            'cluster_id' => $this->cluster->id,
            'discountable_type' => $this->discount_category ? 'App\Models\Category' : 'App\Models\Line',
            'discountable_id' => $this->discount_category ? $this->category_id : $this->line_id,
            'content' => $fields
        ]);

        $this->reset(['fields', 'discount_category', 'category_id', 'line_id', 'open']);

    }

    public function destroyDiscount(Discount $discount){
        $discount->delete();
    }


    public function render()
    {
        return view('livewire.admin.clusters.discounts');
    }
}
