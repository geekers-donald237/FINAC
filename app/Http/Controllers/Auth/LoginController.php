<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // L'authentification a réussi
            return redirect()->intended('/home');
        } else {
            // L'authentification a échoué
            return back()->withErrors(['email' => 'Les informations d\'identification sont incorrectes.'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}