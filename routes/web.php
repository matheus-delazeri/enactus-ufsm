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
    Route::get('/logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
    Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);

    Route::middleware('auth')->group(function () {
        Route::view('/', 'admin.page.dashboard');
        Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
            Route::view('/store', 'admin.page.post')->name('store');
            Route::post('/store', [\App\Http\Controllers\Admin\PostController::class, 'store']);
            Route::get('/edit/{id}', [\App\Http\Controllers\Admin\PostController::class, 'edit']);
            Route::put('/edit/{id}', [\App\Http\Controllers\Admin\PostController::class, 'update'])->name('update');
        });
        });
    });
