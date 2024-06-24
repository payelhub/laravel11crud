<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCRUD;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::controller(ProductController::class)->group(function(){
    Route::get('/products','index')->name('products.index');
    Route::get('/products/create','create')->name('products.create');
    Route::post('/products','store')->name('products.store');
    Route::get('/products/{product}/edit','edit')->name('products.edit');
    Route::put('/products/{product}','update')->name('products.update');
    Route::delete('/products/{product}','destroy')->name('products.destroy');
});
Route::controller(TaskController::class)->group(function(){
    Route::get('/users','index')->name('users.index');
    Route::get('/users/create','create')->name('users.create');
    Route::post('/users','store')->name('users.store');
    Route::get('/users/edit/{id}','edit')->name('users.edit');
    Route::put('/users/{id}','update')->name('users.update');
    Route::delete('/users/{id}','destroy')->name('users.destroy'); 
});

Route::controller(BlogController::class)->group(function(){
    Route::get('/blog','index')->name('blog.index');
    Route::get('/blog/{id}','show')->name('blog.show');
    
});
Route::controller(BlogCRUD::class)->group(function(){
    Route::get('/admin/blog', 'index')->name('blog.index');
    Route::get('/admin/blog/edit/{id}', 'edit')->name('blog.edit');
    Route::get('/admin/blog/create', 'create')->name('blog.create');
    Route::post('/admin/blog', 'store')->name('blog.store');
    Route::put('/admin/blog/{id}', 'update')->name('blog.update');
    Route::delete('/admin/blog/{id}', 'destroy')->name('blog.destroy');
});

    
