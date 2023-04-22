<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LineController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
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

Route::resource('categories', CategoryController::class)
    ->except(['show'])
    ->names('admin.categories');

Route::resource('lines', LineController::class)
    ->except(['show'])
    ->names('admin.lines');