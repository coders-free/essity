<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderSample;
use App\Models\Product;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index()
    {
        return view('samples.index');
    }

    public function freeSample($product_id)
    {
        $type = 'free_sample';

        $product = Product::where($type, true)->findOrFail($product_id);

        return view('samples.show', compact('product', 'type'));
    }

    public function plvMaterial($product_id)
    {
        $type = 'plv_material';

        $product = Product::where($type, true)->findOrFail($product_id);

        return view('samples.show', compact('product', 'type'));
    }

    public function cart()
    {
        return view('samples.cart');
    }

    public function checkout()
    {
        return view('samples.checkout');
    }

    public function store(Request $request){

        $request->validate([
            'nif' => ['required', 'string', 'max:9', 'regex:/^[0-9]{8}[A-Za-z]{1}$/'],
            'message' => 'nullable|string',
        ]);

        Cart::instance('sample');

        $content = Cart::content()->groupBy(function($item){
            return $item->options->type;
        });

        $orderSample = OrderSample::create([
            'user_id' => auth()->id(),
            'nif' => $request->nif,
            'message' => $request->message,
            'content' => $content,
        ]);

        Cart::destroy();
        Cart::store(auth()->id());

        return redirect()->route('samples.thanks', $orderSample);

    }

    public function thanks(OrderSample $orderSample)
    {
        return view('samples.thanks', compact('orderSample'));
    }
}
