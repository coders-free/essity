<?php

namespace App\Http\Livewire\Lines;

use App\Models\Category;
use App\Models\Option;
use Livewire\Component;

class Filter extends Component
{
    public $search;

    public $line, $lines;

    public $selected_categories = [];

    public $selected_features = [];

    public $queryString = [
        'search' => ['except' => ''],
        'selected_categories' => ['except' => []],
        'selected_features' => ['except' => []],
    ];

    public function getAvailableCategoriesProperty(){
        return Category::where('line_id', $this->line->id)
                        ->has('products')
                        ->get();
    }

    public function getOptionsProperty(){

        return Option::whereHas('products', function($query){

            $query->whereHas('category.line', function($query){
                $query->where('id', $this->line->id);
            })->whereDoesntHave('variants', function ($query){

                $query->where(function($query){
                    $query->whereNull('code')
                        ->orWhereNull('image_url');
                });

            });

        })->with(['features' => function($query) {
    
            $query->whereHas('variants.product', function($query) {
                
                $query->whereHas('category.line', function($query){
                    $query->where('id', $this->line->id);
                })->whereDoesntHave('variants', function ($query){
    
                    $query->where(function($query){
                        $query->whereNull('code')
                            ->orWhereNull('image_url');
                    });
    
                });

            });
    
        }])->get();

    }

    public function getFilteredCategoriesProperty(){

        return Category::where('line_id', $this->line->id)
                        ->when($this->selected_categories, function($query){
                            $query->whereIn('id', $this->selected_categories);
                        })->when($this->selected_features, function($query){
                            
                            $query->whereHas('products.variants.features', function($query){
                                $query->whereIn('features.id', $this->selected_features);
                            });

                        })->when($this->search, function($query){
                            
                            $query->whereHas('products', function($query){
                                $query->where('name', 'like', '%'.$this->search.'%');
                            });

                        })
                        ->with(['products' => function($query){

                            $query->when($this->selected_features, function($query){
                                $query->whereHas('variants.features', function($query){
                                    $query->whereIn('features.id', $this->selected_features);
                                });
                            })->when($this->search, function($query){
                                $query->where('name', 'like', '%'.$this->search.'%');
                            })->whereDoesntHave('variants', function ($query){

                                $query->where(function($query){
                                    $query->whereNull('code')
                                        ->orWhereNull('image_url');
                                });

                            });

                        }])
                        ->get();

    }

    public function clearFilters(){
        $this->reset(['selected_categories', 'selected_features']);
    }

    public function remove_category_filter($category_id){
        $this->selected_categories = array_diff($this->selected_categories, [$category_id]);
    }

    public function remove_feature_filter($feature_id){
        $this->selected_features = array_diff($this->selected_features, [$feature_id]);
    }

    public function render()
    {
        return view('livewire.lines.filter');
    }
}
