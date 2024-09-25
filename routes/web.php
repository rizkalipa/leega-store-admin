<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\SubTypeController;

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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user_list');
    Route::get('/create', [UserController::class, 'create'])->name('user_create');
    Route::post('/save', [UserController::class, 'save'])->name('user_save');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user_edit');
    Route::post('/update', [UserController::class, 'update'])->name('user_update');
});

Route::group(['prefix' => 'product', 'middleware' => 'auth'], function () {
    Route::get('/', [ProductController::class, 'index'])->name('product_list');
    Route::get('/create', [ProductController::class, 'create'])->name('product_create');
    Route::post('/save', [ProductController::class, 'save'])->name('product_save');
    Route::get('/edit/{productId}', [ProductController::class, 'edit'])->name('product_edit');
    Route::get('/delete/{productId}', [ProductController::class, 'delete'])->name('product_delete');
    Route::post('/update/{productId}', [ProductController::class, 'update'])->name('product_update');
});

Route::group(['prefix' => 'type-product', 'middleware' => 'auth'], function () {
    Route::get('/', [TypeController::class, 'index'])->name('type_list');
    Route::get('/create', [TypeController::class, 'create'])->name('type_create');
    Route::post('/save', [TypeController::class, 'save'])->name('type_save');
    Route::get('/edit/{typeId}', [TypeController::class, 'edit'])->name('type_edit');
    Route::get('/delete/{typeId}', [TypeController::class, 'delete'])->name('type_delete');
    Route::post('/update/{typeId}', [TypeController::class, 'update'])->name('type_update');
});

Route::group(['prefix' => 'sub-type-product', 'middleware' => 'auth'], function () {
    Route::get('/', [SubTypeController::class, 'index'])->name('sub_type_list');
    Route::get('/create', [SubTypeController::class, 'create'])->name('sub_type_create');
    Route::post('/save', [SubTypeController::class, 'save'])->name('sub_type_save');
    Route::get('/edit/{subTypeId}', [SubTypeController::class, 'edit'])->name('sub_type_edit');
    Route::get('/delete/{subTypeId}', [SubTypeController::class, 'delete'])->name('sub_type_delete');
    Route::post('/update/{subTypeId}', [SubTypeController::class, 'update'])->name('sub_type_update');
});
