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

class userscontroller extends \App\Http\Controllers\login\Controller
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

        return redirect('view/login');

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

            return redirect('view/register')
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


        return redirect('view/users')
            ->with('msgSuccess', $msgSuccess);
    }

    public function getUserByIdToEdit($id_edit)
    {
        if ($this->checkiFThereIsAUserLoggedIn() == true) {

            $users = User::all();

            $user_id = User::find($id_edit);

            return view('users.view_users_users-view', ['users' => $users, 'id_edit' => $id_edit, 'user_id' => $user_id]);

        } else {

            return view('index');

        }

    }

    public function editUser(Request $request, $id, User $user)
    {
        if ($this->checkiFThereIsAUserLoggedIn() == true) {

            $validator = Validator::make($request->all(), ['name' => 'min:5|max:50',
                'email' => 'min:10|max:191|']);

            if ($validator->fails()) {

                return redirect('view/users')
                    ->withErrors($validator)
                    ->withInput($request->all());

            }

            $editAnUser = DB::table('users')->where('id', '=', $id)->update(['name' => $request->name, 'email' => $request->email]);

            $msgSuccess1 = "O produto foi editado com sucesso";

            return redirect('view/users')
                ->with('msgSuccess1', $msgSuccess1);

        } else {

            return view('index');


        }
    }

    public function deleteUser($id, User $user)
    {
        try {
            if ($this->checkiFThereIsAUserLoggedIn() == true) {

                $delete = $user->find($id)->delete();

                $msgDeleteSuccess = "Item deletado com sucesso";

                return redirect('view/users')
                    ->with('msgDeleteSuccess', $msgDeleteSuccess);

            }

        } catch (\Throwable $e) {

        $msgDeleteError = "Não é possível excluir um usuário, sem excluir os produtos cadastrados por ele";;

        return redirect('view/users')
            ->with('msgDeleteError', $msgDeleteError);

    }

}

    public
    function getUserByIdToDelete($id_delete)
    {
        if ($this->checkiFThereIsAUserLoggedIn() == true) {

            $users = User::all();

            return view('users.view_users_users-view', ['users' => $users], ['id_delete' => $id_delete]);

        } else {

            return view('index');


        }
    }


    public
    function authenticateLogin(Request $request, User $user)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $request->session()->regenerate();

            $msgSuccess = "login efetuado com sucesso";

            return redirect('view/login')
                ->with('msgSuccess', $msgSuccess);

        } else {

            $msgError = "Credenciais inválidas";

            return redirect('view/login')
                ->with('msgError', $msgError);

        }
    }

    public
    function checkiFThereIsAUserLoggedIn()
    {
        if (Auth::user()->name == "administrador") {

            return true;

        } else {

            return false;

        }

    }
}



