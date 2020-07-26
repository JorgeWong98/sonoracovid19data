<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function form()
    {
        if (Auth::check()) {
            return redirect('');
        }
        else {
            return view('login');
        }
    }

    function attempt(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('dashboard/registros');
        }
        else{
            return redirect()->back();
        }
    }

    function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('');
        }
        return redirect('');
    }
}
