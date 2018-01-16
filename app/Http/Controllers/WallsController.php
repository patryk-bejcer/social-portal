<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WallsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $friends = Auth::user()->friends();

        $friends_ids_array = [];
        $friends_ids_array[] = Auth::id();

        foreach ($friends as $friend) {
            $friends_ids_array[] = $friend->id;
        }

        if(is_admin()){
            $posts = Post::with('comments.user')
                ->with('likes')
                ->with('comments.likes')
                ->whereIn('user_id', $friends_ids_array)
                ->orderBy('created_at', 'desc')
                ->withTrashed()
                ->paginate(10);
        } else {
            $posts = Post::with('comments.user')
                ->with('likes')
                ->with('comments.likes')
                ->whereIn('user_id', $friends_ids_array)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }



        return view('walls.index', compact('posts'));

    }
}
