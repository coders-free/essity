<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Line;
use Livewire\Component;
use Livewire\WithFileUploads;

use WireUi\Traits\Actions;

class Create extends Component
{
    use Actions;
    use WithFileUploads;
    
    public $image;

    public $categories;

    public $category_id;

    public function mount()
    {
        $this->categories = Category::all();

        $this->category_id = old('category_id', $this->categories->first()->id);
    }


    public function getLineProperty(){
        
        if($this->category_id){

            return Line::whereHas('categories', function($query){
                return $query->where('id', $this->category_id);
            })->with('variants')
            ->first();

        }

        return null;

    }

    public function render()
    {
        return view('livewire.admin.products.create');
    }
}
