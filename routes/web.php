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
            return redirect('/supplier/category');
        } else {
            return redirect('/retailer/suppliers');
        }
    })->middleware(['role:supplier,retailer'])->name('dashboard');

    Route::prefix('supplier')->middleware(['role:supplier'])->group(function() {
        // Route::get('/dashboard', function() {
        //     echo 'supplier dashboard';
        // });
        Route::get('/dashboard', 'App\Http\Controllers\Supplier\DashboardController@index');
        Route::get('/requested', 'App\Http\Controllers\Supplier\RequestedController@index')->name('requested');
        Route::post('/requested/receive', 'App\Http\Controllers\Supplier\RequestedController@receive')->name('requested.receive');
        // super collection
        Route::get('/collection', 'App\Http\Controllers\Supplier\SuperCollectionController@index')->name('collection');
        Route::get('/collection/create', 'App\Http\Controllers\Supplier\SuperCollectionController@create')->name('collection.create');
        Route::get('/collection/edit/{id}', 'App\Http\Controllers\Supplier\SuperCollectionController@edit')->name('collection.edit');

        Route::post('/collection/destroy', 'App\Http\Controllers\Supplier\SuperCollectionController@destroy')->name('collection.destory');
        Route::post('/collection/store', 'App\Http\Controllers\Supplier\SuperCollectionController@store')->name('collection.store');
        Route::post('/collection/update/{id}', 'App\Http\Controllers\Supplier\SuperCollectionController@update')->name('collection.update');
        // collection
        Route::get('/category', 'App\Http\Controllers\Supplier\CollectionController@index')->name('category');
        Route::get('/category/create', 'App\Http\Controllers\Supplier\CollectionController@create')->name('category.create');
        Route::get('/category/edit/{id}', 'App\Http\Controllers\Supplier\CollectionController@edit')->name('category.edit');
        Route::get('/category/show/{id}', 'App\Http\Controllers\Supplier\CollectionController@show')->name('category.show');

        Route::post('/category/destroy', 'App\Http\Controllers\Supplier\CollectionController@destroy')->name('category.destory');
        Route::post('/category/edit_products', 'App\Http\Controllers\Supplier\CollectionController@edit_products')->name('category.edit_products');
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
        Route::post('/profile/update/{id}', 'App\Http\Controllers\Supplier\ProfileController@update')->name('profile.update');
    });

    Route::prefix('retailer')->middleware(['role:retailer'])->group(function() {
        // Route::get('/dashboard', function() {
        //     echo 'retailer dashboard';
        // });
        Route::get('/dashboard', 'App\Http\Controllers\Retailer\DashboardController@index');
        Route::get('/suppliers', 'App\Http\Controllers\Retailer\SupplierListController@index')->name('suppliers');
        Route::post('/suppliers/request', 'App\Http\Controllers\Retailer\SupplierListController@request')->name('suppliers.request');
        Route::get('/suppliers/getCollections/{id}', 'App\Http\Controllers\Retailer\SupplierListController@getCollections')->name('suppliers.getCollections');
        Route::get('/suppliers/getCategories/{id}', 'App\Http\Controllers\Retailer\SupplierListController@getCategories')->name('suppliers.getCategories');
        // product
        Route::get('/product/{id}', 'App\Http\Controllers\Retailer\ProductController@index')->name('r_product');
        Route::get('/product/show/{id}', 'App\Http\Controllers\Retailer\ProductController@show')->name('product.show');

        Route::post('/product/approve', 'App\Http\Controllers\Retailer\ProductController@approve')->name('product.approve');
        Route::post('/product/getChanges', 'App\Http\Controllers\Retailer\ProductController@getChanges')->name('product.getChanges');
        // approved product
        Route::get('/approved_product', 'App\Http\Controllers\Retailer\ApprovedProductController@index')->name('approved_product');
        // profile
        Route::get('/profile', 'App\Http\Controllers\Retailer\ProfileController@index')->name('r_profile');
        Route::post('/profile/update/{id}', 'App\Http\Controllers\Retailer\ProfileController@update')->name('r_profile.update');
    });
});

require __DIR__.'/auth.php';
