<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    public function user_avatar($id, $size)
    {

        $user = User::findOrFail($id);

        if (is_null($user->avatar)){
            $img = Image::make('https://cdn4.iconfinder.com/data/icons/two-colored-flat-set/100/user-256.png')->fit($size)->response('png', 100);
        } else {
            if (strpos($user->avatar, 'http') !== false){
                $img = Image::make($user->avatar)->fit($size)->response('jpg', 90);
            } else {
                $avatar_path = asset('storage/users/' . $id . '/avatars/' . $user->avatar);
                $img = Image::make($avatar_path)->fit($size)->response('jpg', 90);
            }
        }



        return $img;

    }
}
