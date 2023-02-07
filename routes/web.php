<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;


Route::get('/',[ProductsController::class,'products'])->name('products');
Route::post('/add-products',[ProductsController::class,'addproducts'])->name('add.products');
Route::post('/update-products',[ProductsController::class,'updateproducts'])->name('update.products');
Route::post('/delete-products',[ProductsController::class,'deleteproducts'])->name('delete.products');
Route::get('/pagination/pagination-data',[ProductsController::class,'pagination']);
Route::get('/search-product',[ProductsController::class,'searchproducts'])->name('search.products');