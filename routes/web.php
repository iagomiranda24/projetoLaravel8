<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\usersController;
use App\Http\Controllers\produtos\produtosController;

Route::middleware(['auth'])->group(function () {



    Route::get('cadastrar-produtos', [produtosController::class, 'viewCadastraProdutos']);

    Route::get('produtos', [produtosController::class, 'mostraViewDeProdutos']);

    Route::get('produtos/{id}', [produtosController::class, 'mostraProdutoPeloId']);

    Route::post('cadastrar-produto', [produtosController::class, 'logicaCadastrarProdutos']);

    Route::put('editar-produto/{id}', [produtosController::class, 'editarProduto']);

    Route::get('editar-produto/{id}', [produtosController::class, 'pegaProdutoPeloIdParaEditar']);

    Route::get('deletar-produto/{id}', [produtosController::class, 'pegarProdutopeloId']);

    Route::delete('deletar-produto/{id}', [produtosController::class, 'deletarProduto']);

    Route::get('users', [usersController::class, 'listarUsuarios']);
    Route::get('users/{id}', [usersController::class, 'mostraUserPeloId']);

    Route::post('logout', [usersController::class, 'logout']);


    Route::get('editar-usuario/{id}', [usersController::class, 'pegaUsuarioPeloIdParaEditar']);

    Route::put('editar-usuarios/{id}', [usersController::class, 'editarUsuario']);

    Route::get('deletar-usuarios/{id}', [usersController::class, 'pegaUsuarioPeloIdParaDeletar']);

    Route::delete('deletar-usuarios/{id}', [usersController::class, 'deletarUsuario']);

}); 

Route::get('home', [produtosController::class, 'mostraAindex']);

Route::get('cadastrar', [usersController::class, 'viewCadastraUsuarios']);

Route::post('cadastrar-usuarios', [usersController::class, 'logicaCadastrarUsuarios']);

Route::get('login', [produtosController::class, 'viewDeLogin'])->name('login');

Route::post('autentica', [usersController::class, 'authenticate']);

Route::get('/', function () {
    return view('welcome');
});
