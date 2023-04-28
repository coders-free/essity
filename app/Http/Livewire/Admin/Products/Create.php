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

    public $product = [
        'code' => '123',
        'name' => 'ass',
        'details' => 'assa',
        'image_url' => 'assa',
        'category_id' => '1',
        'free_sample' => 1,
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }


    public function getLineProperty(){
        
        if($this->product['category_id']){

            return Line::whereHas('categories', function($query){
                return $query->where('id', $this->product['category_id']);
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
