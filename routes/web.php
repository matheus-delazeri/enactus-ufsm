<?php

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


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::view('/login', 'admin.page.login')->name('login');
    Route::get('/logout', [\App\Http\Controllers\Admin\UserController::class, 'logout'])->name('logout');
    Route::post('/login', [\App\Http\Controllers\Admin\UserController::class, 'login']);

    Route::middleware('auth')->group(function () {
        Route::view('/', 'admin.page.home')->name("home");
        Route::resource('post', \App\Http\Controllers\Admin\PostController::class);

        Route::get('/logout', [\App\Http\Controllers\Admin\UserController::class, 'logout'])->name('logout');
        Route::resource('user', \App\Http\Controllers\Admin\UserController::class);
    });
});
