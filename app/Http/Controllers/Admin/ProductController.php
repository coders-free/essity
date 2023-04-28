<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /* $validate = [
            'image' => 'required|image',
            'code' => 'required|unique:products',
            'name' => 'required',
            'details' => 'required',
            'category_id' => 'required|exists:categories,id',
            'free_sample' => 'boolean',
        ];

        $line = Line::whereHas('categories', function($query) use ($request){
            return $query->where('id', $request->category_id);
        })->with('variants')
        ->first();

        foreach ($line->variants as $variant) {
            $validate[ucfirst($variant->name)] = 'required';
        }


        $data = $request->validate($validate);

        return $request->all(); */


        $data = $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required',
            'details' => 'required',
            'image' => 'required|image',
            'category_id' => 'required|exists:categories,id',
        ]);

        $data['image_url'] = Storage::put('products', $data['image']);

        $product = Product::create($data);

        session()->flash('flash.alert', 'La línea se creó correctamente');

        return redirect()->route('admin.products.edit', $product);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'code' => 'required|unique:products,code,' . $product->id,
            'name' => 'required',
            'details' => 'required',
            'image' => 'nullable|image',
            'category_id' => 'required|exists:categories,id',
            'free_sample' => 'boolean',
        ]);

        if ($request->hasFile('image')) {

            Storage::delete($product->image_url);

            $data['image_url'] = Storage::put('products', $data['image']);
        }

        $product->update($data);

        session()->flash('flash.alert', 'La línea se actualizó correctamente');

        return redirect()->route('admin.products.edit', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
