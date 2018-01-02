<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{


    public function __construct()
    {
        $this->middleware('user_permission', ['except' => ['show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

        $user = User::findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(5);

        return view('users.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = Auth::user();

        return view('users.edit', compact('user'));
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
        $this->validate($request,

            [
                'name' => 'required|min:3|max:30',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($id),
                ]
            ],

            [
                'required' => 'Pole jest wymagane',
                'email' => 'Adres email jest nie poprawny',
                'min' => 'Pole musi zawierać minimum 3 znaki',
                'max' => 'Pole może zawierać maksymalnie 30 znaków',
                'unique' => 'Inny użytkownik ma już taki adres email',
            ]

        );

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->phone = $request->phone;
        $user->city = $request->city;

        if($request->file('avatar')){
            $upload_path = 'public/users/' . $id  . '/avatars';
            $path = $request->file('avatar')->store($upload_path);
            $avatar_filename = str_replace($upload_path . '/', '', $path);
            $user->avatar = $avatar_filename;
        }

        $user->save();
        return back();
    }


}
