<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Line;
use App\Models\Order;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index()
    {

        return view('cart.index');
    }

    public function checkout()
    {
        return view('cart.checkout');
    }

    public function store(Request $request)
    {

        $request->validate([
            'cooperative_id' => auth()->user()->hasRole('farmacia') ? 'required|exists:cooperatives,id' : 'nullable',
            'nif' => ['required', 'string', 'max:9', 'regex:/^[0-9]{8}[A-Za-z]{1}$/'],
            'message' => 'nullable|string',
        ]);

        Cart::instance('shopping');

        $content = Cart::content()->groupBy(function($item){
            $line = Line::find($item->options->line_id);
            return $line->name;

        })->map(function($item){
            return $item->groupBy(function($item){
                $category = Category::find($item->options->category_id);
                return $category->name;
            });
        });
        
        $order = Order::create([
            'user_id' => auth()->id(),
            'cooperative_id' => $request->cooperative_id ?? null,
            'nif' => $request->nif,
            'content' => $content,
            'message' => $request->message,
        ]);

        Cart::destroy();
        Cart::store(auth()->id());


        Mail::to(auth()->user()->email)->send(new \App\Mail\OrderShipped($order));

        return redirect()->route('orders.thanks.index', $order);
    }
}
