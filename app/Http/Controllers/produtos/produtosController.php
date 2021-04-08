<?php

namespace App\Http\Controllers\produtos;

use App\Models\produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class produtosController extends \App\Http\Controllers\login\Controller
{
    public function createProduct()
    {

        return view('products.new_product_product-new');

    }

    public function lookHome()
    {

        return view('index');

    }

    public function lookLogin()
    {
        if(Auth::check() == false) {

            return view('users.view_login_login-view');

        } else {

            return redirect('visualizacao/home');

        }
    }

    public function readProducts()
    {

        $products = produto::all();

        return view('products.view_products_products-view', ['products' => $products]);

    }

    public function getProductByIdTo($id)
    {

        $product = produto::find($id);

        return view('products.view_products_id_view-product-id', ['product' => $product]);

    }

    public function createAnProduct(Request $request)
    {

        $validator = Validator::make($request->all(), ['name' => 'min:5|max:50',
            'descricao' => 'min:10|max:191',
            'estoque' => 'min:1|numeric|integer']);

        if ($validator->fails()) {

            return redirect('novo/produto')
                ->withErrors($validator)
                ->withInput($request->all());

        }

        $produto = new produto();

        $produto->name = $request->name;
        $produto->descricao = $request->descricao;
        $produto->estoque = $request->estoque;

        $msgSuccess = "O produto foi cadastrado com sucesso";

        $produto->save();

        return redirect('novo/produto')
            ->with('msgSuccess', $msgSuccess);

    }

    public function getProductByIdToEdit($id_edit) {

        $products = produto::all();

        $product_id = produto::find($id_edit);

        return view('products.view_products_products-view.blade', ['products' => $products, 'id_edit' => $id_edit, 'produto_Id' => $product_id]);


    }

    public function editProduct(Request $request, $id)
    {

        $validator = Validator::make($request->all(), ['name' => 'min:5|max:50',
            'descricao' => 'min:10|max:191',
            'estoque' => 'min:1|numeric|integer']);

        if ($validator->fails()) {

            return redirect('vizualizacao/produtos')
                ->withErrors($validator)
                ->withInput($request->all());

        }


        $atualizar = DB::table('produtos')->where('id','=',$id)->update(['name' =>$request->name, 'descricao' =>  $request->descricao, 'estoque' => $request->estoque]);

        $msgSuccess1 = "O produto foi cadastrado com sucesso";

        return redirect('vizualizacao/produtos')
            ->with('msgSuccess1', $msgSuccess1);


    }

    public function deleteProduct(produto $produto, $id)
    {
        $deletar = produto::find($id)->delete();

        if ($deletar) {

            $msgDeleteSuccess = "Item deletado com sucesso";

            return redirect('vizualizacao/produtos')
                ->with('msgDeleteSuccess', $msgDeleteSuccess);

        } else {

            $msgDeleteError = "Não foi possível deletar";

            return redirect('vizualizacao/produtos')
                ->with('msgDeleteError', $msgDeleteError);

        }
    }

    public function getProductByIdToDelete($id_delete, produto $produto)
    {

        $products = produto::all();

        return view('products.view_products_products-view.blade', ['products' => $products], ['id_delete' => $id_delete]);
    }
}

