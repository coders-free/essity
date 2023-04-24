<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\TwoFactorAuthCodeController;
use Illuminate\Support\Facades\Route;

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

});