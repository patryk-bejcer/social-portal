<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Image;
use Illuminate\Support\Facades\Auth;

class UsersGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::find($user_id);
        $images = User::find($user_id)->images()->paginate(18);
        return view('gallery.index', compact('user', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        if ( ! Auth::check() ||  Auth::id() != $id  && !is_admin()) {
            abort(403, 'Brak dostępu');
        }

        $user = User::findOrfail($id);

        return view('gallery.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        if($request->file('images')) {

            foreach ($request->images as $image) {

                $upload_path = 'public/users/' . $id  . '/gallery';
                $image->store($upload_path);
                $filename = $image->hashName();

                Image::create([
                    'user_id' => $id,
                    'filename' => $filename,
                ]);

            }
        }

        return back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ( ! Auth::check() ||  Auth::id() != $id  && !is_admin()) {
            abort(403, 'Brak dostępu');
        }

        $user = User::find($id);
        $images = User::find($id)->images()->paginate(18);
        return view('gallery.edit', compact('user', 'images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if ( ! Auth::check() ||  Auth::id() != $id  && !is_admin()) {
            abort(403, 'Brak dostępu');
        }

        foreach ($request->check_img as $id) {
            $image = Image::findOrFail($id);
            $image->delete();
        }

        return back();
    }
}
