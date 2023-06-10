<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::controller(\App\Http\Controllers\UserController::class)->group(function () {

    Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
        Route::get('/',  'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/create',  'create')->name('create');
        Route::get('view/{id}', 'view')->name('view');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('status', 'status')->name('status');
        Route::post('/update/{id}',  'update')->name('update');
        Route::get('/list', 'list')->name('list');
        Route::post('delete',  'destroy')->name('delete');



    });
});



