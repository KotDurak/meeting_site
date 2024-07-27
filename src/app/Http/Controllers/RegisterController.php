<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Mail\RegisterShipped;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $registerData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'name' => ['required'],
            'gender' => ['required', Rule::enum(Gender::class)],
            'birthday' => ['required'],
            'city_id'   => ['integer', 'required'],
        ]);

        if(User::where('email', $registerData['email'])->exists()) {
            abort(400, 'Такой пользователь уже зарегистрирован');
        }

        $user = User::make([
            'email' => $registerData['email'],
            'name'  => $registerData['name'],
            'birthday'  => $registerData['birthday'],
            'gender'    => $registerData['gender'],
            'city_id'   => $registerData['city_id'],
        ]);

        $user->password = Hash::make($registerData['password']);
        $user->sms = $this->getSms();
        $user->last_sms_generated = Carbon::now();
        $user->save();

       // Mail::to($user)->send(new RegisterShipped($user));

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

    public function confirm(Request $request)
    {
        $request->validate([
            'code'  => ['required'],
        ]);

        $code = trim($request->input('code'));

        /**
         * @var User $user
        */
        $user = User::where('sms', $code)->first();

        if (empty($user)) {
            abort(400, 'Не верный код подтверждения');
        }

        $user->is_activated = 1;
        $user->sms = '';
        $user->save();

        Auth::login($user, true);

        return [
            'code'  => 0,
            'message' => 'OK'
        ];
    }

    public function retryConfirm()
    {
        /**
         * @var User $user
        */
        $user = Auth::getUser();

        $current = Carbon::now();
        $lastActivated = new Carbon($user->last_sms_generated);
        $time = $current->diff($lastActivated);

        if ($time->i < User::MINUTES_DURABLE) {
            $message = sprintf('С момента отправки письма должно пройти минимум  %s минут', User::MINUTES_DURABLE);
            abort(400, $message);
        }

        $user->sms = $this->getSms();
        $user->last_sms_generated = Carbon::now();
        $user->save();
        Mail::to($user)->send(new RegisterShipped($user));

        return [
            'code'    => 0,
            'message' => 'OK',
        ];
    }
}
