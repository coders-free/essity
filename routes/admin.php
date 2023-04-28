<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LineController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VariantController;
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

Route::resource('variants', VariantController::class)
    ->except(['show'])
    ->names('admin.variants');

Route::resource('lines', LineController::class)
    ->except(['show'])
    ->names('admin.lines');

Route::resource('categories', CategoryController::class)
    ->except(['show'])
    ->names('admin.categories');

Route::get('products/{product}/variants', [ProductController::class, 'variants'])
    ->name('admin.products.variants');

Route::resource('products', ProductController::class)
    ->except(['show'])
    ->names('admin.products');

Route::post('orders/{order}/approve', [OrderController::class, 'approve'])
    ->name('admin.orders.approve');
    
Route::resource('orders', OrderController::class)
    ->names('admin.orders');

Route::resource('messages', MessageController::class)
    ->names('admin.messages');