<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cluster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.clusters.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clusters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $cluster = Cluster::create($request->all());

        session()->flash('flash.alert', 'El cluster se ha creado correctamente');

        return redirect()->route('admin.clusters.edit', $cluster);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cluster $cluster)
    {
        return view('admin.clusters.show', compact('cluster'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cluster $cluster)
    {
        return view('admin.clusters.edit', compact('cluster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cluster $cluster)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $cluster->update($request->all());

        session()->flash('flash.alert', 'El cluster se ha actualizado correctamente');

        return redirect()->route('admin.clusters.edit', $cluster);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cluster $cluster)
    {
        $cluster->delete();

        session()->flash('flash.alert', 'El cluster se ha eliminado correctamente');

        return redirect()->route('admin.clusters.index');
    }
}
