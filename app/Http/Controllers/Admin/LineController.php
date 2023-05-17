<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.lines.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $variants = Variant::all();

        return view('admin.lines.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:lines,name',
            'variants' => 'required',
            'image' => 'required|image',
        ]);

        //Variantes
        $variants = $request->variants;
        $variants = str_replace('[', '', $variants);
        $variants = str_replace(']', '', $variants);
        $variants = explode(',', $variants);

        $data['image_url'] = $request->file('image')->store('lines');

        $line = Line::create($data);
        $line->variants()->sync($variants);

        return redirect()->route('admin.lines.edit', $line)
            ->with('flash.alert', 'La línea se creó correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Line $line)
    {
        return view('admin.lines.show', compact('line'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Line $line)
    {

        $options = Option::all();

        return view('admin.lines.edit', compact('line', 'options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Line $line)
    {
        $data = $request->validate([
            'name' => 'required|unique:lines,name,' . $line->id,
            'options' => 'required',
            'image' => 'nullable|image'
        ]);


        $options = $request->options;

        $options = str_replace('[', '', $options);
        $options = str_replace(']', '', $options);

        $options = explode(',', $options);

        if ($request->hasFile('image')) {

            Storage::delete($line->image_url);

            $data['image_url'] = Storage::put('lines', $request->file('image'));
        }

        $line->update($data);

        $line->options()->sync($options);

        return redirect()->route('admin.lines.edit', $line)
            ->with('flash.alert', 'La línea se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
