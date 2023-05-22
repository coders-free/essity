<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Line;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart as CartFacade;
use Livewire\Component;

class Cart extends Component
{

    public $instance = 'shopping';

    public function getLinesProperty(){
        CartFacade::instance($this->instance);

        return CartFacade::content()->groupBy(function($item){
            $line = Line::find($item->options->line_id);
            return $line->name;

        })->map(function($item){
            return $item->groupBy(function($item){
                $category = Category::find($item->options->category_id);
                return $category->name;
            });
        });

    }

    public function getTypesProperty(){
        CartFacade::instance($this->instance);

        return CartFacade::content()->groupBy(function($item){
            return $item->options->type;
        });

    }

    //Disminuir la cantidad de un producto
    public function decrease($rowId){

        CartFacade::instance($this->instance);
        $item = CartFacade::get($rowId);

        if($item->qty == 1){

            CartFacade::remove($rowId);

        }else{
            $qty = $item->qty - 1;
            CartFacade::update($rowId, $qty);
        }

        CartFacade::store(auth()->id());
        
    }

    //Aumentar la cantidad de un producto
    public function increase($rowId){

        CartFacade::instance($this->instance);
        $item = CartFacade::get($rowId);
        $qty = $item->qty + 1;
        CartFacade::update($rowId, $qty);

        CartFacade::store(auth()->id());
    }

    public function remove($rowId){
        CartFacade::instance($this->instance);
        CartFacade::remove($rowId);

        CartFacade::store(auth()->id());
    }

    public function destroy(){
        CartFacade::instance($this->instance);
        CartFacade::destroy();

        CartFacade::store(auth()->id());
    }

    //Confirmar la compra
    public function checkout(){

        Order::create([
            'user_id' => auth()->id(),
            'nif' => auth()->user()->profile->nif_1,
            'content' => $this->lines,
        ]);

        $this->destroy();

        if ($this->instance == 'shopping') {
            return redirect()->route('products.history');
        }

    }

    public function render()
    {
        return view('livewire.products.cart');
    }
}
