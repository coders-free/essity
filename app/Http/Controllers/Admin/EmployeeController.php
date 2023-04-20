<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employees.index');
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role_id);

        session()->flash('flash.alert', 'El usuario se creó correctamente');

        return redirect()->route('admin.employees.edit', $user);
    }

    public function edit(User $user)
    {
        return view('admin.employees.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        session()->flash('flash.alert', 'El usuario se actualizó correctamente');

        return redirect()->route('admin.employees.edit', $user);
        
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
