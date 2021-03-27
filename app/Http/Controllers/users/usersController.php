<?php

namespace App\Http\Controllers\users;

use App\Models\produto;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;
use Symfony\Component\Console\Input\Input;

class usersController extends \App\Http\Controllers\login\Controller
{
    public function listarUsuarios()
    {
        if ($this->verificaSeExisteUsuarioLogado() == true) {
            $users = User::all();

            return view('users.listar-usuarios', ['users' => $users]);;

        } else {

            return view('index');

        }

    }

    public function index()
    {

        return view('index');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');

    }


    public function mostraUserPeloId($id)
    {
        if ($this->verificaSeExisteUsuarioLogado() == true) {

            $user = User::find($id);

            return view('users.listar-usuarios-pelo-id', ['user' => $user]);

        } else {

            return view('index');

        }

    }

    public function viewCadastraUsuarios()
    {

        return view('users.cadastro-login');
    }

    public function logicaCadastrarUsuarios(Request $request)
    {

        $validator = Validator::make($request->all(), ['name' => 'min:5|required|max:50',
            'email' => 'min:10|max:191|unique:users,email',
            'password' => 'min:8|confirmed']);

        if ($validator->fails()) {

            return redirect('cadastrar')
                ->withErrors($validator)
                ->withInput($request->all());

        }

        $hashed = Hash::make($request->password);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $hashed;

        $msgSuccess = "O usuário foi cadastrado com sucesso";

        $user->save();

        return redirect('users')
            ->with('msgSuccess', $msgSuccess);
    }

    public function pegaUsuarioPeloIdParaEditar($id_editar)
    {
        if ($this->verificaSeExisteUsuarioLogado() == true) {

            $users = User::all();

            $userComId = User::find($id_editar);

            return view('users.listar-usuarios', ['users' => $users, 'id_editar' => $id_editar, 'userComId' => $userComId]);

        } else {

            return view('index');

        }

    }

    public function editarUsuario(Request $request, $id, User $user)
    {
        if ($this->verificaSeExisteUsuarioLogado() == true) {

            $validator = Validator::make($request->all(), ['name' => 'min:5|max:50',
                'email' => 'min:10|max:191|unique:users,email']);

            if ($validator->fails()) {

                return redirect('users')
                    ->withErrors($validator)
                    ->withInput($request->all());

            }

            $atualizar = DB::table('users')->where('id', '=', $id)->update(['name' => $request->name, 'email' => $request->email]);

            $msgSuccess1 = "O produto foi editado    com sucesso";

            return redirect('users')
                ->with('msgSuccess1', $msgSuccess1);

        } else {

            return view('index');


        }
    }

    public function deletarUsuario($id, User $user)
    {
        if ($this->verificaSeExisteUsuarioLogado() == true) {


            $deletar = $user->find($id)->delete();

            if ($deletar) {

                $msgDeleteSuccess = "Item deletado com sucesso";

                return redirect('/users')
                    ->with('msgDeleteSuccess', $msgDeleteSuccess);

            } else {

                $msgDeleteError = "Não foi possível deletar";

                return redirect('/users')
                    ->with('msgDeleteError', $msgDeleteError);

            }

        } else {

            return view('index');


        }
    }

    public function pegaUsuarioPeloIdParaDeletar($id_delete)
    {
        if ($this->verificaSeExisteUsuarioLogado() == true) {

            $users = User::all();

            return view('users.listar-usuarios', ['users' => $users], ['id_delete' => $id_delete]);

        } else {

            return view('index');


        }
    }


    public function authenticate(Request $request, User $user)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $request->session()->regenerate();

            $msgSuccess = "login efetuado com sucesso";

            return redirect('home')
                ->with('msgSuccess', $msgSuccess);

        } else {

            $msgError = "Credenciais inválidas";

            return redirect('login')
                ->with('msgError', $msgError);

        }
    }

    public function verificaSeExisteUsuarioLogado()
    {
        if (Auth::user()->name == "administrador") {

            return true;

        } else {

            return false;

        }

    }
}



