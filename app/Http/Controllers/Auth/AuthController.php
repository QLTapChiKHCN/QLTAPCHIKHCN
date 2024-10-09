<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Showlogin()
    {
        return view('Auth.Login');
    }

    public function ShowRegister()
    {
        return view('Auth.Register');
    }

    public function logout()
    {
        return ;
    }
}
