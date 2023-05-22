<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Line;
use App\Models\Order;
use App\Models\Product;
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

        //Calcular el estado del pedido
        $status = true;
        if (!auth()->user()->profile->unlimited) {
        
            //Pedidos por mes
            $orders_count = auth()->user()->orders()->whereMonth('created_at', '=', date('m'))->count();
            $max_orders_per_month = auth()->user()->profile->max_orders_per_month;

            $status = $max_orders_per_month > $orders_count;

            //Pedidos por categoria
            $qty_products_category = Cart::content()->groupBy(function($item){
                return $item->options->category_id;
            })->map(function($item){
                return $item->sum('qty');
            });

            $categories = Category::whereIn('id', $qty_products_category->keys())->get();
            
            foreach ($categories as $category) {
                $qty = $qty_products_category[$category->id];
                if($qty > $category->maximum_orders){
                    $status = false;
                }
            }

        }
        
        //Actualizar los productos
        Product::whereIn('id', Cart::content()->pluck('id'))->update([
            'purchase_made' => true,
        ]);

        //Calcular descuentos
        $content = Cart::content();
        $discounts = auth()->user()->profile->cluster->discounts;
        $dcto_total = [];

        foreach ($discounts as $discount) {

            $dcto = 0;
            
            if ($discount->discountable_type == Line::class) {
                
                $products_qty = $content->where('options.line_id', $discount->discountable_id)->sum('qty');
            
                foreach ($discount->content as $item) {
                    
                    if ($products_qty >= $item->quantity) {
                        $dcto = $item->discount;
                    }

                }

                if ($dcto > 0) {
                    $dcto_total[] = [
                        'type' => Line::find($discount->discountable_id)->name,
                        'discount' => $dcto,
                    ];
                }

            }

            if ($discount->discountable_type == Category::class) {
                
                $products_qty = $content->whereIn('options.category_id', $discount->discountable_id)->sum('qty');
            
                foreach ($discount->content as $item) {
                    
                    if ($products_qty >= $item->quantity) {
                        $dcto = $item->discount;
                    }

                }

                if ($dcto > 0) {
                    $dcto_total[] = [
                        'type' => Category::find($discount->discountable_id)->name,
                        'discount' => $dcto,
                    ];
                }


            }

        }

        //Reagrupar los productos por linea y categoria
        $content = Cart::content()->groupBy(function($item){
            $line = Line::find($item->options->line_id);
            return $line->name;

        })->map(function($item){
            return $item->groupBy(function($item){
                $category = Category::find($item->options->category_id);
                return $category->name;
            });
        });
        
        //Crear la orden
        $order = Order::create([
            'user_id' => auth()->id(),
            'cooperative_id' => $request->cooperative_id ?? null,
            'nif' => $request->nif,
            'content' => $content,
            'message' => $request->message,
            'status' => $status,
            'discounts' => $dcto_total,
        ]);

        //Vaciar el carrito
        Cart::destroy();
        Cart::store(auth()->id());

        //Enviar el correo
        Mail::to(auth()->user()->email)->send(new \App\Mail\OrderShipped($order));

        return redirect()->route('orders.thanks.index', $order);
    }
}
