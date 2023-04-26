<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\TwoFactorAuthCodeController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::middleware(['guest'])->group(function () {

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::get('/register/farmacia', [RegisteredUserController::class, 'farmacia'])
        ->name('register.farmacia');

    Route::get('/register/ortopedia', [RegisteredUserController::class, 'ortopedia'])
        ->name('register.ortopedia');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');


    Route::get('/admin/login', function () {
        /* return view('admin.auth.login'); */
        return 'Inicia sesion';

    })->name('admin.login');


});

Route::middleware(['auth'])->group(function () {

    Route::get('/two-factor-challenge', [TwoFactorAuthCodeController::class, 'challenge'])
        ->name('two-factor.challenge');

    Route::post('/two-factor-challenge', [TwoFactorAuthCodeController::class, 'verify'])
        ->name('two-factor.verify');

    Route::get('/two-factor-challenge/code', function () {
        
        $code = Str::random(6);

        session(['auth.2fa.code' => $code]);

        Mail::to(auth()->user()->email)
                    ->send(new \App\Mail\TwoFactorVerification($code));

        

        session()->flash('flash.banner', 'Se ha enviado un codigo a su correo electronico');

        return redirect()->route('two-factor.challenge');

    })->name('two-factor.code');

});