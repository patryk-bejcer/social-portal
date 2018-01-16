<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('post_permission', ['except' => ['store','show']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'content' => 'required|min:5',
        ], [
            'required' => 'Pole jest wymagane',
            'min' => 'Pole musi mieć minimum :min znaków',
        ]);

       Post::create([
           'user_id' => Auth::id(),
           'content' => $request['content'],
       ]);

       return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_admin()) {
            $post = Post::findOrFail($id)->withTrashed();
        } else {
            $post = Post::findOrFail($id);
        }

        return view('posts.show', compact('post'));
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
            $post = Post::withTrashed()->findOrFail($id);
        } else {
            $post = Post::findOrFail($id);
        }

        return view('posts.edit', compact('post'));
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
            $post = Post::withTrashed()->findOrFail($id);
        } else {
            $post = Post::findOrFail($id);
        }

        $post->content = $request->content;
        $post->save();

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
        $post = Post::find($id);
        $post->delete();
        $post->comments()->delete();

        return back();
    }
}
