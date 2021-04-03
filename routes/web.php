<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\usersController;
use App\Http\Controllers\produtos\produtosController;

Route::middleware(['auth'])->group(function () {

    Route::get('novo/produto', [produtosController::class, 'createProduct'])->name('product.get.new.product');

    Route::get('visualizacao/produtos', [produtosController::class, 'readProducts'])->name('product.get.view.product');

    Route::get('visualizacao/produto/{id}', [produtosController::class, 'getProductByIdTo'])->name('product.get.view.product.id');

    Route::post('visualizacao/cadastrar/produtos', [produtosController::class, 'createAnProduct'])->name('product.post.new.product');

    Route::put('editar/produto/{id}', [produtosController::class, 'editProduct'])->name('product.put.edit.product.view.id');

    Route::get('editar/produto/{id}', [produtosController::class, 'getProductByIdToEdit'])->name('product.get.view.id');

    Route::get('deletar/produto/{id}', [produtosController::class, 'getProductByIdToDelete'])->name('product.get.delete.view.id');

    Route::delete('deletar/produto/{id}', [produtosController::class, 'deleteProduct'])->name('product.delete.view.id');

    Route::get('visualizacao/usuarios', [usersController::class, 'readUsers'])->name('user.get.view');

    Route::get('usuario/{id}', [usersController::class, 'getUserById'])->name('user.get.view.id');

    Route::post('logout', [usersController::class, 'logoutUser'])->name('logout.post.view.id');

    Route::get('editar/usuario/{id}', [usersController::class, 'getUserByIdToEdit'])->name('user.get.view.id');

    Route::put('editar/usuario/{id}', [usersController::class, 'editUser'])->name('user.put.view.id');

    Route::get('deletar/usuario/{id}', [usersController::class, 'getUserByIdToDelete'])->name('user.get.view.id');

    Route::delete('deletar/usuario/{id}', [usersController::class, 'deleteUser'])->name('user.delete.view.id');

});

Route::group(['middleware' => ['web']], function () {

    Route::get('visualizacao/home', [produtosController::class, 'lookHome'])->name('home.get.view');

    Route::get('visualizacao/cadastrar', [usersController::class, 'newUser'])->name('user.post.view');

    Route::post('visualizacao/cadastrar/usuario', [usersController::class, 'createAnUser'])->name('user.post.view');

    Route::get('visualizacao/login', [produtosController::class, 'lookLogin'])->name('login.get.view');

    Route::post('autentica/login', [usersController::class, 'authenticateLogin'])->name('login.autentica.post.view');

    Route::get('/', function () {
        return view('welcome');

    });
});
