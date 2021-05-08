<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\userscontroller;
use App\Http\Controllers\produtos\produtoscontroller;

Route::middleware(['auth'])->group(function () {

    Route::get('new/product', [produtoscontroller::class, 'createProduct'])->name('product.get.new.product');

    Route::get('view/products', [produtoscontroller::class, 'readProducts'])->name('product.get.view.product');

    Route::get('view/product/{id}', [produtoscontroller::class, 'getProductByIdTo'])->name('product.get.view.product.id');

    Route::post('view/register/product', [produtoscontroller::class, 'createAnProduct'])->name('product.post.new.product');

    Route::put('edit/product/{id}', [produtoscontroller::class, 'editProduct'])->name('product.put.edit.product.view.id');

    Route::get('edit/product/{id}', [produtoscontroller::class, 'getProductByIdToEdit'])->name('product.get.view.id');

    Route::get('delete/product/{id}', [produtoscontroller::class, 'getProductByIdToDelete'])->name('product.get.delete.view.id');

    Route::delete('delete/product/{id}', [produtoscontroller::class, 'deleteProduct'])->name('product.delete.view.id');

    Route::get('view/users', [userscontroller::class, 'readUsers'])->name('user.get.view');

    Route::get('view/user/{id}', [userscontroller::class, 'getUserById'])->name('user.get.view.id');

    Route::post('logout', [userscontroller::class, 'logoutUser'])->name('logout.post.view.id');

    Route::get('edit/user/{id}', [userscontroller::class, 'getUserByIdToEdit'])->name('user.get.view.id');

    Route::put('edit/user/{id}', [userscontroller::class, 'editUser'])->name('user.put.view.id');

    Route::get('delete/user/{id}', [userscontroller::class, 'getUserByIdToDelete'])->name('user.get.view.id');

    Route::delete('delete/user/{id}', [userscontroller::class, 'deleteUser'])->name('user.delete.view.id');

});

Route::group(['middleware' => ['web']], function () {

    Route::get('view/home', [produtoscontroller::class, 'lookHome'])->name('home.get.view');

    Route::get('view/register', [userscontroller::class, 'newUser'])->name('user.post.view');

    Route::post('view/register/user', [userscontroller::class, 'createAnUser'])->name('user.post.view');

    Route::get('view/login', [produtoscontroller::class, 'lookLogin'])->name('login.get.view');

    Route::post('autenticate/login', [userscontroller::class, 'authenticateLogin'])->name('login.autentica.post.view');

    Route::get('/', function () {
        return view('welcome');

    });
});
