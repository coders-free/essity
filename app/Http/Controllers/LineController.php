<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Line;
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

        /* $line->load(['categories', 'categories.products']); */

        $line->load(['categories' => function($query){
            $query->when(request('category_id'), function($query, $category_id){
                $query->where('id', $category_id);
            })->with('products');
        }]);


        $lines = Line::all();
        $categories = Category::where('line_id', $line->id)->get();

        return view('lines.show', compact('line', 'lines', 'categories'));
    }
}
