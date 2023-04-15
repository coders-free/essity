<?php

namespace App\Http\Controllers;

use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function index(){
        return view('contact.index');
    }

    public function store(Request $request){

        $request->validate([
            'pharmacy_name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'province' => 'required',
            'phone' => 'required',
            'nif_1' => 'required|digits:5',
            'nif_2' => 'nullable|digits:5',
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'terms' => 'required|accepted',
            'g-recaptcha-response' => ['required', new Recaptcha],
        ]);


        return redirect()->route('contact.index')->with('flash.banner', 'Gracias por tu mensaje. Estaremos en contacto.');
    }
}
