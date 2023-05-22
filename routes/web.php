<?php

use App\Http\Controllers\LineController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\ThankController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\WelcomeController;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Support\Facades\Route;

use Gloudemans\Shoppingcart\Facades\Cart;

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
            ->name('orders.lines.index');

        Route::get('/lineas/{line}', [LineController::class, 'show'])
            ->name('orders.lines.show');

        Route::get('/products/{product}', [ProductController::class, 'show'])
            ->name('orders.products.show');

        Route::get('cart', [CartController::class, 'index'])
            ->name('orders.cart.index');

        Route::get('cart/checkout', [CartController::class, 'checkout'])
            ->name('orders.cart.checkout');

        Route::post('cart/checkout', [CartController::class, 'store'])
            ->name('orders.cart.store');

        Route::get('gracias/{order}', [ThankController::class, 'index'])
            ->name('orders.thanks.index');

        Route::get('history', [HistoryController::class, 'index'])
            ->name('history');


        Route::get('samples', [SampleController::class, 'index'])
            ->name('samples.index');

        Route::get('samples/products/{product}/free-sample', [SampleController::class, 'freeSample'])
            ->name('samples.free-sample');

        Route::get('samples/products/{product}/plv-material', [SampleController::class, 'plvMaterial'])
            ->name('samples.plv-material');

        Route::get('samples/cart', [SampleController::class, 'cart'])
            ->name('samples.cart');

        Route::get('samples/cart/checkout', [SampleController::class, 'checkout'])
            ->name('samples.cart.checkout');

        Route::post('samples/cart/checkout', [SampleController::class, 'store'])
            ->name('samples.cart.store');

        Route::get('samples/gracias/{orderSample}', [SampleController::class, 'thanks'])
            ->name('samples.thanks');

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

    Cart::instance('sample');

    return Cart::content()->groupBy(function($item){
        return $item->options->type;
    });

});
