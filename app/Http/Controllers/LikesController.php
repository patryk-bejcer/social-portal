<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function add(Request $request){

        if($request->like_type == 'post'){
            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $request['post_id'],
            ]);
        } else {
            Like::create([
                'user_id' => Auth::id(),
                'comment_id' => $request['comment_id'],
            ]);
        }

        return back();

    }

    public function destroy(Request $request){

        Like::where([
            'user_id' => Auth::id(),
            'post_id' => $request['post_id'],
            'comment_id' => $request['comment_id'],
        ])->delete();

        return back();

    }

	public function like(Request $request)
	{

		return Like::create([
			'user_id' => request('user'),
			'post_id' => request('post'),
		]);

	}

}
