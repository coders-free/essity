<?php

use App\Http\Controllers\RegisteredUserController;
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

});