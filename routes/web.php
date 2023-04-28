<?php

use App\Http\Controllers\LineController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    
    Route::middleware(['is-admin', 'verified', '2fa', 'account-to-verify'])->group(function () {

        Route::get('/', WelcomeController::class)
            ->name('welcome');

        Route::get('/lineas', [LineController::class, 'index'])
            ->name('lines.index');

        Route::get('/lineas/{line}', [LineController::class, 'show'])
            ->name('lines.show');

        /* Route::get('/lineas/{line?}/{category?}', [ProductController::class, 'index'])
            ->name('lines.index')
            ->scopeBindings(); */

        /* Route::get('/linea/{line?}/{category?}', [LineController::class, 'show'])
            ->name('products.index')
            ->scopeBindings(); */

        Route::get('products/history', [ProductController::class, 'history'])
            ->name('products.history');

        Route::get('/products/{product}', [ProductController::class, 'show'])
            ->name('products.show');

        Route::get('cart', [CartController::class, 'index'])
            ->name('cart.index');

        Route::get('cart/checkout', [CartController::class, 'checkout'])
            ->name('cart.checkout');

        Route::post('cart/checkout', [CartController::class, 'store'])
            ->name('cart.store');

        Route::get('webinars', [WebinarController::class, 'index'])
            ->name('webinars.index');
    
    });

    Route::get('account-to-verify', function () {

        if(auth()->user()->active){
            return redirect()->route('welcome');
        }

        return view('account-to-verify');
    })->name('account-to-verify');
});


Route::get('contact', [ContactController::class, 'index'])
    ->name('contact.index');

Route::post('contact', [ContactController::class, 'store'])
    ->name('contact.store');


Route::view('rules-of-use', 'privacy-policy')->name('rules-of-use');
Route::view('privacy-policy', 'privacy-policy')->name('privacy-policy');
Route::view('cookie-policy', 'privacy-policy')->name('cookie-policy');
Route::view('faq', 'privacy-policy')->name('faq');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/* Route::view('prueba', 'emails.welcome-message'); */

Route::get('prueba', function () {
    dd(auth()->user()->hasRole(['farmacia']));
});
