<?php

namespace App\Http\Livewire\Samples;

use App\Models\Category;
use App\Models\Option;
use Livewire\Component;

class Filter extends Component
{
    public $search = '';

    public $type = 'free_sample';

    public $selected_categories = [];
    public $selected_features = [];

    protected $queryString = [
        'type',
        'search' => ['except' => ''],
        'selected_categories' => ['except' => []],
        'selected_features' => ['except' => []],
    ];

    public function mount(){
        if($this->type != 'free_sample' && $this->type != 'plv_material'){
            $this->type = 'free_sample';
        }
    }

    public function getOptionsProperty(){
        return Option::whereHas('products', function($query){
            $query->where($this->type, true)
                ->when($this->selected_categories, function($query){
                    $query->whereHas('category', function($query){
                        $query->whereIn('id', $this->selected_categories);
                    });
                })->whereDoesntHave('variants', function ($query){
                    $query->where(function($query){
                        $query->whereNull('code')
                            ->orWhereNull('image_url');
                    });
                });
        })->with(['features' => function($query){
            $query->whereHas('variants.product', function($query){
                $query->where($this->type, true)
                    ->when($this->selected_categories, function($query){
                        $query->whereHas('category', function($query){
                            $query->whereIn('id', $this->selected_categories);
                        });
                    })->whereDoesntHave('variants', function ($query){
                        $query->where(function($query){
                            $query->whereNull('code')
                                ->orWhereNull('image_url');
                        });
                    });
            });
        }])->get();
    }

    public function getAvailableCategoriesProperty(){
        return Category::whereHas('products', function($query){
            $query->where($this->type, true);
        })->get();
    }

    public function getFilteredCategoriesProperty(){
        return Category::when($this->selected_categories, function($query){
            $query->whereIn('id', $this->selected_categories);
        })->whereHas('products', function($query){
            $query->where($this->type, true)
                ->when($this->search, function($query){
                    $query->where('name', 'like', '%'.$this->search.'%');
                })->when($this->selected_features, function($query){
                    $query->whereHas('variants.features', function($query){
                        $query->whereIn('features.id', $this->selected_features);
                    });
                })->whereDoesntHave('variants', function ($query){

                    $query->where(function($query){
                        $query->whereNull('code')
                            ->orWhereNull('image_url');
                    });

                });
        })->with(['products' => function($query){
            $query->where($this->type, true)
                ->when($this->search, function($query){
                    $query->where('name', 'like', '%'.$this->search.'%');
                })->when($this->selected_features, function($query){
                    $query->whereHas('variants.features', function($query){
                        $query->whereIn('features.id', $this->selected_features);
                    });
                })->whereDoesntHave('variants', function ($query){

                    $query->where(function($query){
                        $query->whereNull('code')
                            ->orWhereNull('image_url');
                    });

                });
        }])->get();

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
        return view('livewire.samples.filter');
    }
}
