<?php

use App\Http\Controllers\Api\Select2Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/select2/provinces', [Select2Controller::class, 'provinces'])
    ->name('select2.provinces');

Route::get('/select2/towns', [Select2Controller::class, 'towns'])
    ->name('select2.towns');

Route::get('/select2/cooperatives', [Select2Controller::class, 'cooperatives'])
    ->name('select2.cooperatives');

Route::get('/products', function(Request $request){

    $search = $request->search;

    return \App\Models\Product::where('name', 'like', '%' . $search . '%')
        ->when(
            $request->exists('selected'),
            fn ($query) => $query->whereIn('id', $request->input('selected', [])),
            fn ($query) => $query->limit(10)
        )
        ->get();

})->name('api.products.index');


Route::get('/features', function(Request $request){

    /* return \App\Models\Feature::select('id', 'name as text')
            ->when($request->variant_id, function($query, $variant_id){
                return $query->where('variant_id', $variant_id);
            })
            ->when($request->term, function($query, $term){
                return $query->where('name', 'like', '%' . $term . '%');
            })
            ->get(); */

    return \App\Models\Feature::select('id', 'value')
            ->when($request->option_id, function($query, $option_id){
                return $query->where('option_id', $option_id);
            })
            ->when($request->search, function($query, $search){
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', [])),
                fn ($query) => $query->limit(10)
            )
            ->get();

})->name('api.features.index');