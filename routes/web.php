<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\usersController;
use App\Http\Controllers\produtos\produtosController;

Route::middleware(['auth'])->group(function () {

    Route::get('new/product', [produtosController::class, 'createProduct'])->name('product.get.new.product');

    Route::get('view/products', [produtosController::class, 'readProducts'])->name('product.get.view.product');

    Route::get('view/product/{id}', [produtosController::class, 'getProductByIdTo'])->name('product.get.view.product.id');

    Route::post('view/register/product', [produtosController::class, 'createAnProduct'])->name('product.post.new.product');

    Route::put('edit/product/{id}', [produtosController::class, 'editProduct'])->name('product.put.edit.product.view.id');

    Route::get('edit/product/{id}', [produtosController::class, 'getProductByIdToEdit'])->name('product.get.view.id');

    Route::get('delete/product/{id}', [produtosController::class, 'getProductByIdToDelete'])->name('product.get.delete.view.id');

    Route::delete('delete/product/{id}', [produtosController::class, 'deleteProduct'])->name('product.delete.view.id');

    Route::get('view/users', [usersController::class, 'readUsers'])->name('user.get.view');

    Route::get('users/{id}', [usersController::class, 'getUserById'])->name('user.get.view.id');

    Route::post('logout', [usersController::class, 'logoutUser'])->name('logout.post.view.id');

    Route::get('edit/users/{id}', [usersController::class, 'getUserByIdToEdit'])->name('user.get.view.id');

    Route::put('edit/users/{id}', [usersController::class, 'editUser'])->name('user.put.view.id');

    Route::get('delete/users/{id}', [usersController::class, 'getUserByIdToDelete'])->name('user.get.view.id');

    Route::delete('delete/users/{id}', [usersController::class, 'deleteUser'])->name('user.delete.view.id');

});

Route::group(['middleware' => ['web']], function () {

    Route::get('view/home', [produtosController::class, 'lookHome'])->name('home.get.view');

    Route::get('view/register', [usersController::class, 'newUser'])->name('user.post.view');

    Route::post('view/register/user', [usersController::class, 'createAnUser'])->name('user.post.view');

    Route::get('view/login', [produtosController::class, 'lookLogin'])->name('login.get.view');

    Route::post('autenticate/login', [usersController::class, 'authenticateLogin'])->name('login.autentica.post.view');

    Route::get('/', function () {
        return view('welcome');

    });
});
