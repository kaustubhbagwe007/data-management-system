<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.authenticate');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboards.index');

    Route::resource('roles', RoleController::class)->except('show');

    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');

    Route::resource('users', UserController::class)->except('show');

    Route::resource('categories', CategoryController::class)->except('show');

    Route::resource('products', ProductController::class)->except('show');

});