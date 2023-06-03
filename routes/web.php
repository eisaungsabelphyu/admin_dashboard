<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;


Route::middleware('admin_auth')->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('admin#loginPage');
});

Route::middleware('auth:sanctum')->group(function(){

    Route::prefix('item')->group(function(){
    Route::get('list',[ItemController::class,'list'])->name('admin#itemList');
    Route::get('create',[ItemController::class,'create'])->name('admin#createItem');
    Route::post('store',[ItemController::class,'store'])->name('admin#storeItem');
    Route::get('edit/{item}',[ItemController::class,'edit'])->name('admin#editItem');
    Route::post('update/{item}',[ItemController::class,'update'])->name('admin#updateItem');
    Route::get('delete/{item}',[ItemController::class,'delete'])->name('admin#deleteItem');

    });

    Route::prefix('category')->group(function(){
        Route::get('list',[CategoryController::class,'list'])->name('admin#categoryList');
        Route::get('create',[CategoryController::class,'create'])->name('admin#createCategory');
        Route::post('store',[CategoryController::class,'store'])->name('admin#storeCategory');
        Route::get('edit/{category}',[CategoryController::class,'edit'])->name('admin#editCategory');
        Route::post('update/{category}',[CategoryController::class,'update'])->name('admin#updateCategory');
        Route::get('delete/{category}',[CategoryController::class,'delete'])->name('admin#deleteCategory');
    });
});
