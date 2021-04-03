<?php

namespace App\Http\Controllers\users;

use App\Models\produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;
use Symfony\Component\Console\Input\Input;

class usersController extends \App\Http\Controllers\login\Controller
{
    public function readUsers()
    {
        if ($this->checkiFThereIsAUserLoggedIn() == true) {
            $users = User::all();

            return view('users.view_users_users-view', ['users' => $users]);;

        } else {

            return view('index');

        }

    }

    public function logoutUser(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('visualizacao/login');

    }


    public function getUserById($id)
    {
        if ($this->checkiFThereIsAUserLoggedIn() == true) {

            $user = User::find($id);

            return view('users.view_users_users-view-by-id', ['user' => $user]);

        } else {

            return view('index');

        }

    }

    public function newUser()
    {

        return view('users.view_register_register-view');
    }

    public function createAnUser(Request $request)
    {

        $validator = Validator::make($request->all(), ['name' => 'min:5|required|max:50',
            'email' => 'min:10|max:191|unique:users,email',
            'password' => 'min:8|confirmed']);

        if ($validator->fails()) {

            return redirect('visualizacao/cadastrar')
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

        return redirect('visualizacao/usuarios')
            ->with('msgSuccess', $msgSuccess);
    }

    public function getUserByIdToEdit($id_editar)
    {
        if ($this->checkiFThereIsAUserLoggedIn() == true) {

            $users = User::all();

            $userComId = User::find($id_editar);

            return view('users.view_users_users-view', ['users' => $users, 'id_editar' => $id_editar, 'userComId' => $userComId]);

        } else {

            return view('index');

        }

    }

    public function editUser(Request $request, $id, User $user)
    {
        if ($this->checkiFThereIsAUserLoggedIn() == true) {

            $validator = Validator::make($request->all(), ['name' => 'min:5|max:50',
                'email' => 'min:10|max:191|unique:users,email']);

            if ($validator->fails()) {

                return redirect('visualizacao/usuarios')
                    ->withErrors($validator)
                    ->withInput($request->all());

            }

            $atualizar = DB::table('users')->where('id', '=', $id)->update(['name' => $request->name, 'email' => $request->email]);

            $msgSuccess1 = "O produto foi editado com sucesso";

            return redirect('visualizacao/usuarios')
                ->with('msgSuccess1', $msgSuccess1);

        } else {

            return view('index');


        }
    }

    public function deleteUser($id, User $user)
    {
        if ($this->checkiFThereIsAUserLoggedIn() == true) {


            $deletar = $user->find($id)->delete();

            if ($deletar) {

                $msgDeleteSuccess = "Item deletado com sucesso";

                return redirect('visualizacao/usuarios')
                    ->with('msgDeleteSuccess', $msgDeleteSuccess);

            } else {

                $msgDeleteError = "Não foi possível deletar";

                return redirect('visualizacao/usuarios')
                    ->with('msgDeleteError', $msgDeleteError);

            }

        } else {

            return view('index');


        }
    }

    public function getUserByIdToDelete($id_delete)
    {
        if ($this->checkiFThereIsAUserLoggedIn() == true) {

            $users = User::all();

            return view('users.view_users_users-view', ['users' => $users], ['id_delete' => $id_delete]);

        } else {

            return view('index');


        }
    }


    public function authenticateLogin(Request $request, User $user)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $request->session()->regenerate();

            $msgSuccess = "login efetuado com sucesso";

            return redirect('visualizacao/login')
                ->with('msgSuccess', $msgSuccess);

        } else {

            $msgError = "Credenciais inválidas";

            return redirect('login')
                ->with('msgError', $msgError);

        }
    }

    public function checkiFThereIsAUserLoggedIn()
    {
        if (Auth::user()->name == "administrador") {

            return true;

        } else {

            return false;

        }

    }
}



