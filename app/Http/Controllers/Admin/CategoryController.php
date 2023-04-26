<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Line;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lines = Line::all();

        return view('admin.categories.create', compact('lines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'line_id' => 'required|exists:lines,id',
            'maximum_orders' => 'required|integer|min:1',
        ]);

        $category = Category::create($data);

        session()->flash('flash.alert', 'La categoría se creó correctamente');

        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $lines = Line::all();

        return view('admin.categories.edit', compact('category', 'lines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'line_id' => 'required|exists:lines,id',
            'maximum_orders' => 'required|integer|min:1',
        ]);

        $category->update($data);

        session()->flash('flash.alert', 'La categoría se actualizó correctamente');

        return redirect()->route('admin.categories.edit', $category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
