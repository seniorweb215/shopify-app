<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

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
    if(!Auth::check()) {
        return redirect('/login');
    } else {
        return redirect('/dashboard');
    }
    
});

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        $type = Auth::user()->type;
        if($type == 1) {
            return redirect('/supplier/dashboard');
        } else {
            return redirect('/retailer/dashboard');
        }
    })->middleware(['role:supplier,retailer'])->name('dashboard');

    Route::prefix('supplier')->middleware(['role:supplier'])->group(function() {
        // Route::get('/dashboard', function() {
        //     echo 'supplier dashboard';
        // });
        Route::get('/dashboard', 'App\Http\Controllers\Supplier\DashboardController@index');
        // collection
        Route::get('/category', 'App\Http\Controllers\Supplier\CollectionController@index')->name('category');
        Route::get('/category/create', 'App\Http\Controllers\Supplier\CollectionController@create')->name('category.create');
        Route::get('/category/edit/{id}', 'App\Http\Controllers\Supplier\CollectionController@edit')->name('category.edit');

        Route::post('/category/destroy', 'App\Http\Controllers\Supplier\CollectionController@destroy')->name('category.destory');
        Route::post('/category/store', 'App\Http\Controllers\Supplier\CollectionController@store')->name('category.store');
        Route::post('/category/update/{id}', 'App\Http\Controllers\Supplier\CollectionController@update')->name('category.update');
        // product
        Route::get('/product', 'App\Http\Controllers\Supplier\ProductController@index')->name('product');
        Route::get('/product/create', 'App\Http\Controllers\Supplier\ProductController@create')->name('product.create');
        Route::get('/product/edit/{id}', 'App\Http\Controllers\Supplier\ProductController@edit')->name('product.edit');

        Route::post('/product/store', 'App\Http\Controllers\Supplier\ProductController@store')->name('product.store');
        Route::post('/product/update/{id}', 'App\Http\Controllers\Supplier\ProductController@update')->name('product.update');
        Route::post('/product/destroy', 'App\Http\Controllers\Supplier\ProductController@destroy')->name('product.destory');
        // profile
        Route::get('/profile', 'App\Http\Controllers\Supplier\ProfileController@index')->name('profile');
    });

    Route::prefix('retailer')->middleware(['role:retailer'])->group(function() {
        // Route::get('/dashboard', function() {
        //     echo 'retailer dashboard';
        // });
        Route::get('/dashboard', 'App\Http\Controllers\Retailer\DashboardController@index');
    });
});

require __DIR__.'/auth.php';
