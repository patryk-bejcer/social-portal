<?php

namespace App\Http\Controllers;

use App\User;
use App\Image as GalleryImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{
    public function user_avatar($id, $size)
    {

        $user = User::findOrFail($id);

        if (is_null($user->avatar)){
            $img = Image::make(asset('img/user-avatar.png'))->fit($size)->response('png', 100);
        } else {
            if (strpos($user->avatar, 'http') !== false){
                $img = Image::make($user->avatar)->fit($size)->response('jpg', 90);
//	            $img = Image::make(asset('img/user-avatar.png'))->fit($size)->response('png', 100);
            } else {
                $avatar_path = asset('storage/users/' . $id . '/avatars/' . $user->avatar);
                $img = Image::make($avatar_path)->fit($size)->response('jpg', 90);
//                $img = Image::make(asset('img/user-avatar.png'))->fit($size)->response('png', 100);
            }
        }



        return $img;

    }

    public function user_gallery($user_id, $img_id, $size)
    {
        $gallery_image = GalleryImage::findOrFail($img_id);

        $avatar_path = asset('storage/users/' . $user_id . '/gallery/' . $gallery_image->filename);
        $img = Image::make($avatar_path)->fit($size)->response('jpg', 95);

        return $img;
    }


}
