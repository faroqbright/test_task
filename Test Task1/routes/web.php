<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CartController;

Route::get('/', [SearchController::class, 'index'])->name('search.index');
Route::get('/companies/{country}/{id}', [CompanyController::class, 'show'])->name('companies.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{index}', [CartController::class, 'remove'])->name('cart.remove');
