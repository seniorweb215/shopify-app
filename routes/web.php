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
        Route::get('/dashboard', function() {
            echo 'supplier dashboard';
        });
    });

    Route::prefix('retailer')->middleware(['role:retailer'])->group(function() {
        Route::get('/dashboard', function() {
            echo 'retailer dashboard';
        });
    });
});

require __DIR__.'/auth.php';
