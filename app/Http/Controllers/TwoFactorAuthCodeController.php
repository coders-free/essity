<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFactorAuthCodeController extends Controller
{
    public function challenge()
    {
        return view('auth.two-factor-challenge');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);


        if ($request->code == session('auth.2fa.code')) {

            //Eliminar la variable de sesion
            session()->forget('auth.2fa.code');
            return redirect()->intended();

        }else{
            
            session()->flash('flash.bannerStyle', 'danger');
            session()->flash('flash.banner', 'El codigo de verificacion es incorrecto');
            return back();
            
        }

        
    }
}
