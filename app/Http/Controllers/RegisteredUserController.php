<?php

namespace App\Http\Controllers;

use App\Models\Cooperative;
use App\Models\Province;
use App\Models\Town;
use App\Models\User;
use App\Rules\Recaptcha;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function farmacia(){

        $province_old = Province::find(old('province_id'));
        $town_old = Town::find(old('town_id'));
        
        $cooperative1_old = Cooperative::find(old('cooperative1_id'));
        $cooperative2_old = Cooperative::find(old('cooperative2_id'));
        $cooperative3_old = Cooperative::find(old('cooperative3_id'));
        
        return view('auth.register-farmacia', compact('province_old', 'town_old', 'cooperative1_old', 'cooperative2_old', 'cooperative3_old'));
    }

    public function ortopedia(){

        $province_old = Province::find(old('province_id'));
        $town_old = Town::find(old('town_id'));

        return view('auth.register-ortopedia', compact('province_old', 'town_old'));
    }

    public function store(Request $request)
    {

        $validate = [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'pharmacy_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'cp' => 'required|integer|digits_between:1,5',
            'province_id' => 'required|integer|exists:provinces,id',
            'town_id' => 'required|integer|exists:towns,id',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'nif_1' => ['required', 'string', 'max:9', 'regex:/^[0-9]{8}[A-Za-z]{1}$/'],
            'nif_2' => ['required', 'string', 'max:9', 'regex:/^[0-9]{8}[A-Za-z]{1}$/'],
            'role' => 'required|in:farmacia,ortopedia',
            'terms' => 'required|accepted',
            'g-recaptcha-response' => ['required', new Recaptcha],
        ];

        if($request->role == 'farmacia'){
            $validate['cooperative1_id'] = 'required|integer|exists:cooperatives,id';
            $validate['cooperative1_number'] = ($request->input('cooperative1_id') ? 'required' : 'nullable') . '|integer|digits_between:1,5';

            $validate['cooperative2_id'] = 'nullable|integer|exists:cooperatives,id';
            $validate['cooperative2_number'] = ($request->input('cooperative2_id') ? 'required' : 'nullable') . '|integer|digits_between:1,5';

            $validate['cooperative3_id'] = 'nullable|integer|exists:cooperatives,id';
            $validate['cooperative3_number'] = ($request->input('cooperative3_id') ? 'required' : 'nullable') . '|integer|digits_between:1,5';
        }

        $request->validate($validate);


        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->profile()->create([
            'pharmacy_name' => $request->pharmacy_name,
            'address' => $request->address,
            'cp' => $request->cp,
            'province_id' => $request->province_id,
            'town_id' => $request->town_id,
            'phone' => $request->phone,
            'nif_1' => $request->nif_1,
            'nif_2' => $request->nif_2,
        ]);


        if($request->role == 'farmacia')
        {
            $user->cooperatives()
                ->attach($request->cooperative1_id, [
                    'cooperative_number' => $request->cooperative1_number
                ]);

            if ($request->cooperative2_id) {
                $user->cooperatives()
                    ->attach($request->cooperative2_id, [
                        'cooperative_number' => $request->cooperative2_number
                    ]);
            }

            if ($request->cooperative3_id) {
                $user->cooperatives()
                    ->attach($request->cooperative3_id, [
                        'cooperative_number' => $request->cooperative3_number
                    ]);
            }
        }

        $user->assignRole($request->role);

        /* $user->sendEmailVerificationNotification(); */

        auth()->login($user);

        //Emitir evento de usuario registrado
        event(new Registered($user));

        return redirect()->route('welcome');
        
    }
    
    public function exito(){
        return view('auth.register-exito');
    }
}
