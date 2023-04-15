<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Line;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Line $line = null, Category $category = null){

        if ($line == null) {
            $line = Line::first();

            return redirect()->route('products.index', $line);
        }

        $line->load(['categories' => function($query) use ($category){
            $query->when($category, function($query, $category){
                $query->where('id', $category->id);
            })->with('products');
        }]);

        /* return $line->categories; */

        $lines = Line::all();
        $categories = Category::where('line_id', $line->id)->get();

        /* return $categories; */

        return view('products.index', compact('lines', 'line', 'categories'));
    }

    public function show(Product $product){
        return view('products.show', compact('product'));
    }

    public function history(){

        $orders = Order::where('user_id', auth()->id())
                    ->filter([
                        'order_id' => request('order_id'),
                        'status' => request('status'),
                        'from_date' => request('from_date'),
                        'to_date' => request('to_date'),
                    ])
                    ->get();

        return view('products.history', compact('orders'));
    }
}
