<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has('auth_token')){
            return view('page.dashboard');
        } else {
            return redirect('user/login');
            // ->route('login');
        }
    }
}
