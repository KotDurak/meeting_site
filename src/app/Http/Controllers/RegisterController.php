<?php

namespace App\Http\Controllers;

use App\Mail\RegisterShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $registerData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'name'     => ['required'],
        ]);

        Mail::to('DarkProkuror@mail.ru')->send(new RegisterShipped());

        return [
            'code'  => 0,
            'message' => 'OK'
        ];
    }

    public function confirm()
    {

    }
}
