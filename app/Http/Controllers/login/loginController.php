<?php

namespace App\Http\Controllers\login;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function index() {

        return view('login-cadastro.cadastro-login');

    }
}
