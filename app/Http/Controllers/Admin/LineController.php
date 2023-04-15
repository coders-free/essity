<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Line;
use Illuminate\Http\Request;

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
        return view('admin.lines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:lines,name',
        ]);

        $line = Line::create($request->all());

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
        return view('admin.lines.edit', compact('line'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Line $line)
    {
        $request->validate([
            'name' => 'required|unique:lines,name,' . $line->id,
        ]);

        $line->update($request->all());

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
