<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClusterController;
use App\Http\Controllers\Admin\DigitalMaterialController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LineController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SampleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\Admin\WebinarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::resource('roles', RoleController::class)
    ->except(['show'])
    ->names('admin.roles');

Route::resource('employees', EmployeeController::class)
    ->parameters(['employees' => 'user'])
    ->except(['show'])
    ->names('admin.employees');

Route::resource('users', UserController::class)
    ->except(['show'])
    ->names('admin.users');

Route::post('users/{user}/ban', [UserController::class, 'ban'])
    ->name('admin.users.ban');

Route::resource('options', OptionController::class)
    ->except(['show'])
    ->names('admin.options');

Route::resource('lines', LineController::class)
    ->except(['show'])
    ->names('admin.lines');

Route::resource('categories', CategoryController::class)
    ->except(['show'])
    ->names('admin.categories');

Route::get('products/{product}/variants/{variant}', [ProductController::class, 'variants'])
    ->name('admin.products.variants')
    ->scopeBindings();

Route::put('products/{product}/variants/{variant}', [ProductController::class, 'variantsUpdate'])
    ->name('admin.products.variants.update')
    ->scopeBindings();

Route::resource('products', ProductController::class)
    ->except(['show'])
    ->names('admin.products');

Route::resource('clusters', ClusterController::class)
    ->names('admin.clusters');

Route::post('orders/{order}/approve', [OrderController::class, 'approve'])
    ->name('admin.orders.approve');
    
Route::resource('orders', OrderController::class)
    ->names('admin.orders');

Route::resource('samples', SampleController::class)
    ->parameters(['samples' => 'orderSample'])
    ->names('admin.samples');

Route::get('digital-materials', [DigitalMaterialController::class, 'index'])
    ->name('admin.digital-materials');

Route::resource('webinars', WebinarController::class)
    ->names('admin.webinars');

Route::resource('messages', MessageController::class)
    ->names('admin.messages');