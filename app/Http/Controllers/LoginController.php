<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function signin(Request $request)
    {
        if ($request->session()->has('auth_token')) {
            //sudah login
            return redirect('page/dashboard');
        } else {
            $error = '';
            return view('user.login', compact('error'));
        }
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            $error = 'Login Gagal';
            return view('user.login', compact('error'));
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return view('page.dashboard', compact('token'));
    }

    public function signup()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return view('user.login', compact('token'));
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return redirect('user/sign-in');
    }
}
