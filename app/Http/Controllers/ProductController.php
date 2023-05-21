<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Line;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Line $line = null, Category $category = null){

        if ($line == null) {
            $line = Line::first();

            return redirect()->route('lines.index', $line);
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

        return view('products.index', compact('lines', 'line', 'categories', 'category'));
    }

    public function show($product_id){

        $product = Product::publishedVariants()
                    ->findOrFail($product_id);

        return view('products.show', compact('product'));
    }

}
