<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, true)) {
            return [
                'code'      => 0,
                'message'   => 'OK'
            ];
        }

        abort(400, 'Неверный логин или пароль');
    }

    public function logout()
    {
        Auth::logout();

        return [
            'code'  => 0,
            'message'   => 'OK'
        ];
    }
}
