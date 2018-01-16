<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('comment_permission', ['except' => ['store']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_id_comment_content = 'post_' . $request->post_id .'_comment_content';

        $this->validate($request, [
            $post_id_comment_content => 'required|min:5',
        ], [
            'required' => 'Musisz wpisać jakąś treść',
            'min' => 'Treść musi mieć minimum :min znaków',
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'content' => $request->$post_id_comment_content,
        ]);

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


        if (is_admin()) {
            $comment = Comment::withTrashed()->findOrfail($id);
        } else {
            $comment = Comment::findOrfail($id);
        }

        return view('comments.edit', compact('comment'));
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
        $this->validate($request,[
            'content' => 'required|min:5',
        ], [
            'required' => 'Pole jest wymagane',
            'min' => 'Pole musi mieć minimum :min znaków',
        ]);

        if (is_admin()) {
            $comment = Comment::withTrashed()->findOrfail($id);
        } else {
            $comment = Comment::findOrfail($id);
        }

        $comment->content = $request->content;
        $comment->save();

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
        Comment::where([
            'id' => $id,
        ])->delete();

        return back();
    }
}
