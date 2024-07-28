<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function getProfile()
    {
        /**
         * @var User $user
        */
        $user = User::with([
            'city',
            'images',
        ])
            ->where('id', Auth::id())
            ->first();

        $result = $user->toArray();
        $result['images'] = $user->images()->get()->map(function(UserImage $img) {
            return array_merge($img->toArray(), ['photo_url' => $img->imageUrl]);
        })->toArray();

        return [
            'user'  => $result,
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
            'photo' => ['file', 'extensions:jpg,png,jpeg', 'max:1024'],
        ]);

        $userId = Auth::id();
        /**
         * @var User $user
        */
        $user = User::findOrFail($userId);

        /**
         * @var UserImage $userImage
        */
        $userImage = UserImage::where('user_id', $userId)->first();

        $photo = $request->file('photo');
        $path  = $photo->store('uploads', ['disk' => 'public']);

        if (!empty($userImage)) {
            Storage::disk('public')->delete($userImage->image);
        }

        if (empty($userImage)) {
            $user->images()->save(new UserImage([
                'image' => $path
            ]));
        } else {
            $userImage->image = $path;
            $userImage->save();
        }

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
        /**
         * @var UserImage $image
        */
        $image = Auth::user()->images()->first();

        if (!empty($image)) {
            return response([
                'code'  => 0,
                'message'   => 'OK',
                'file'  => Storage::url($image->image),
            ]);
        }

        return response([
            'code' => 1,
            'message'   => 'У вас нет загруженных фотографий'
        ], 404);
    }
}
