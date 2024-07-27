<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $user = User::with('city')
            ->where('id', Auth::id())
            ->first();

        return [
            'user'  => $user,
        ];
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();

        /**
         * @var User $user
        */
        $user = Auth::user();
        $user->fill($data);

        return response([
            'code'  => 0,
            'message'   => 'OK',
            'result'    => $user->save(),
        ]);
    }
}
