<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequestRemove;
use App\Notifications\FriendRequestSend;
use App\Notifications\FriendRequestAccepted;
use App\User;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Friend;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('friends.index', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($friend_id)
    {
        if ( ! friendship($friend_id)->exists && ! friendship($friend_id)->accepted) {


            Friend::create([
                'user_id' => Auth::id(),
                'friend_id' => $friend_id,
            ]);

            $dane = 'daneee';

            User::findOrFail($friend_id)->notify(new FriendRequestSend($dane));

        } else {
            $this->accept($friend_id);
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($friend_id)
    {
        Friend::where([
            'user_id' => $friend_id,
            'friend_id' => Auth::id(),
        ])->update([
            'accepted' => 1,
        ]);

        User::findOrFail($friend_id)->notify(new FriendRequestAccepted());

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($friend_id)
    {
        Friend::where([
            'user_id' => Auth::id(),
            'friend_id' => $friend_id,
        ])->orWhere([
            'user_id' => $friend_id,
            'friend_id' => Auth::id(),
        ])->delete();

        User::findOrFail($friend_id)->notify(new FriendRequestRemove());

        return back();
    }
}
