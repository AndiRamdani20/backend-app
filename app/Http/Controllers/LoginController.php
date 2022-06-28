<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        $error = '';
        return view('user.login', compact('error'));
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('page/dashboard');
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/user/sign-in');
        }
    }
}
