<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        return view('admin.roles.index');
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        session()->flash('flash.alert', 'El rol se ha creado con éxito');

        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role){
        return view('admin.roles.edit', compact('role'));
    }
}
