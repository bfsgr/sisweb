<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Str;

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

    public function newPassword(): View|RedirectResponse
    {
        if (auth()->check()) {
            abort(403);
        }


        return view('new-password', [
            'token' => request()->token,
            'email' => request()->email,
        ]);
    }

    public function update(): RedirectResponse
    {

        $validated = request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $validated,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
