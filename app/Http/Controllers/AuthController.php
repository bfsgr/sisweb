<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (auth()->check()) {
            return redirect('/comments');
        }

        return view('login');
    }

    public function login(): RedirectResponse
    {
        $credentials = request()->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect('/comments');
        } else {
            return redirect('/login')->with('error', 'Credenciais inválidas.');
        }
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect('/login');
    }
}
