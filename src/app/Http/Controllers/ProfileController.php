<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;

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

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'photo' => ['file', 'extensions:jpg,png,jpeg'],
        ]);

        $user = Auth::user();
        $photo = $request->file('photo');
        $path  = $photo->store('public/uploads');

        return response([
            'code'      => 0,
            'message'   => 'OK',
            'result'    => [
                'path'  => $path,
            ]
        ]);
    }

    public function getPhoto()
    {
        $file  = Storage::get('/public/uploads/UxVhHiHNZ1CYyytENpJYuzTLs37OCqmIqB5xQBAL.png');
        $file = Storage::url('uploads/UxVhHiHNZ1CYyytENpJYuzTLs37OCqmIqB5xQBAL.png');

        return response([
            'file'  => $file
        ]);
    }
}
