<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::findOrFail($id);

//        var_dump($user);
//        exti;

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (intval($id) !== Auth::id()) {
            abort(403, 'Brak dostępu');
        } else {
            $user = Auth::user();
        }

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

        if (intval($id) !== Auth::id()) {
            abort(403,  'Brak dostępu');
        }

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
        $user->save();



        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
