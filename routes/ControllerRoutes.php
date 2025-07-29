<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\SingleActionController;
use App\Http\Controllers\UserControler;
use App\Http\Controllers\ClientsControler;
use App\Http\Controllers\ProductsControler;
use Illuminate\Support\Facades\Route;

Route::get('/init', [MainController::class, 'init']);
Route::get('/view', [MainController::class, 'view']);

// route para controller de  single action
Route::get('/single', SingleActionController::class)->name('singleW');

// Route para controller do tipo resource
Route::resource('users', UserControler::class);

Route::resources([
    'clients' => ClientsControler::class,
    'products' => ProductsControler::class,
]);