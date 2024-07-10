<?php

namespace App\Http\Controllers;

use App\Mail\RegisterShipped;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $registerData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'name'     => ['required'],
        ]);

        if(User::where('email', $registerData['email'])->exists()) {
            abort(400, 'Такой пользователь уже зарегистрирован');
        }

        $user = User::make([
            'email' => $registerData['email'],
            'name'  => $registerData['name'],
        ]);

        $user->password = Hash::make($registerData['password']);
        $user->sms = $this->getSms();
        $user->save();


        Mail::to('DarkProkuror@mail.ru')->send(new RegisterShipped($user));

        return [
            'code'  => 0,
            'message' => 'OK'
        ];
    }

    private function getSms(): string
    {
        do {
            $smsCode = (string)rand(1000, 9999);
        } while(User::where('sms', $smsCode)->exists());

        return $smsCode;
    }

    public function confirm()
    {

    }
}
