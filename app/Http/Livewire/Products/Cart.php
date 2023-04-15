<?php

namespace App\Http\Livewire\Products;

use App\Models\Category;
use App\Models\Line;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart as CartFacade;
use Livewire\Component;

class Cart extends Component
{

    public function getLinesProperty(){
        CartFacade::instance('shopping');

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

    //Disminuir la cantidad de un producto
    public function decrease($rowId){

        CartFacade::instance('shopping');
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

        CartFacade::instance('shopping');
        $item = CartFacade::get($rowId);
        $qty = $item->qty + 1;
        CartFacade::update($rowId, $qty);

        CartFacade::store(auth()->id());
    }

    public function remove($rowId){
        CartFacade::instance('shopping');
        CartFacade::remove($rowId);

        CartFacade::store(auth()->id());
    }

    public function destroy(){
        CartFacade::instance('shopping');
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

        return redirect()->route('products.history');
    }

    public function render()
    {
        return view('livewire.products.cart');
    }
}
