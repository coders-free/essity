<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Line;
use App\Models\Option;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class LineController extends Controller
{

    public function index()
    {

        $lines = Line::all();

        return view('lines.index', compact('lines'));
    }


    public function show(Line $line)
    {

        Cart::instance('shopping');
        $content = Cart::content();

        //Calcular descuentos
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

        $lines = Line::all();
        
        return view('lines.show', compact('line', 'lines', 'dcto_total'));

    }
}
