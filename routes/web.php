<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\TableLayoutController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::resource('menu', MenuItemController::class);
    Route::delete('tables/{table}/destroy', [TableLayoutController::class, 'destroy'])->name('tables.destroy');
    Route::resource('tables', TableLayoutController::class);
    Route::post('/tables/update-position', [TableLayoutController::class, 'updatePosition'])->name('tables.updatePosition');
});

