<?php

namespace App\Http\Controllers\Admin;

use App\Models\Webinar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebinarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.webinars.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.webinars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'description' => 'required|max:255',
            'video_url' => ['required', 'regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=))([\w-]{10,12})(?:&\S+)?%x']
        ]);

        $webinar = Webinar::create($data);

        session()->flash('flash.alert', 'El video se ha creado correctamente');

        return redirect()->route('admin.webinars.edit', $webinar);
    }

    /**
     * Display the specified resource.
     */
    public function show(Webinar $webinar)
    {
        return view('admin.webinars.show', compact('webinar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Webinar $webinar)
    {
        return view('admin.webinars.edit', compact('webinar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Webinar $webinar)
    {

        $data = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'description' => 'required|max:255',
            'video_url' => ['required', 'regex:%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=))([\w-]{10,12})(?:&\S+)?%x']
        ]);

        $webinar->update($data);

        session()->flash('flash.alert', 'El video se ha actualizado correctamente');

        return redirect()->route('admin.webinars.edit', $webinar);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Webinar $webinar)
    {
        $webinar->delete();

        session()->flash('flash.alert', 'El video se ha eliminado correctamente');

        return redirect()->route('admin.webinars.index');
    }
}
