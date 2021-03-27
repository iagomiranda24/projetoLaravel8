<?php

namespace App\Http\Controllers\produtos;

use App\Models\produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class produtosController extends \App\Http\Controllers\login\Controller
{
    public function viewCadastraProdutos()
    {

        return view('produtos.cadastrar-produto');

    }

    public function mostraAindex()
    {

        return view('index');

    }

    public function viewDeLogin()
    {

        return view('users.login');

    }

    public function mostraViewDeProdutos()
    {

        $produtos = produto::all();

        return view('produtos.listar-produtos', ['produtos' => $produtos]);

    }

    public function mostraProdutoPeloId($id)
    {

        $produto = produto::find($id);

        return view('produtos.listar-produtos-pelo-id', ['produto' => $produto]);

    }

    public function logicaCadastrarProdutos(Request $request)
    {

        $validator = Validator::make($request->all(), ['name' => 'min:5|max:50',
            'descricao' => 'min:10|max:191',
            'estoque' => 'min:1|numeric|integer']);

        if ($validator->fails()) {

            return redirect('cadastrar-produtos')
                ->withErrors($validator)
                ->withInput($request->all());

        }

        $produto = new produto();

        $produto->name = $request->name;
        $produto->descricao = $request->descricao;
        $produto->estoque = $request->estoque;

        $msgSuccess = "O produto foi cadastrado com sucesso";

        $produto->save();

        return redirect('cadastrar-produtos')
            ->with('msgSuccess', $msgSuccess);
    }

    public function pegaProdutoPeloIdParaEditar($id_editar) {

        $produtos = produto::all();

        $produtoComId = produto::find($id_editar);

        return view('produtos.listar-produtos', ['produtos' => $produtos, 'id_editar' => $id_editar, 'produtoComId' => $produtoComId]);


    }

    public function editarProduto(Request $request, $id, produto $produto)
    {

        $validator = Validator::make($request->all(), ['name' => 'min:5|max:50',
            'descricao' => 'min:10|max:191',
            'estoque' => 'min:1|numeric|integer']);

        if ($validator->fails()) {

            return redirect('produtos')
                ->withErrors($validator)
                ->withInput($request->all());

        }


        $atualizar = DB::table('produtos')->where('id','=',$id)->update(['name' =>$request->name, 'descricao' =>  $request->descricao, 'estoque' => $request->estoque]);

        $msgSuccess1 = "O produto foi cadastrado com sucesso";

        return redirect('produtos')
            ->with('msgSuccess1', $msgSuccess1);


    }

    public function deletarProduto(produto $produto, $id)
    {
        $deletar = produto::find($id)->delete();

        if ($deletar) {

            $msgDeleteSuccess = "Item deletado com sucesso";

            return redirect('/produtos')
                ->with('msgDeleteSuccess', $msgDeleteSuccess);

        } else {

            $msgDeleteError = "Não foi possível deletar";

            return redirect('/produtos')
                ->with('msgDeleteError', $msgDeleteError);

        }
    }

    public function pegarProdutopeloId($id_delete, produto $produto)
    {

        $produtos = produto::all();

        return view('produtos.listar-produtos', ['produtos' => $produtos], ['id_delete' => $id_delete]);
    }
}

