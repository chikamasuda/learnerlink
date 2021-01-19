<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all() ;
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index',['posts' => $posts]);
    }

    public function add(Request $request)
    {
        $post = new Post;
        $post->user_id = Auth::user()->id;
        $post->content = $request->content;
        $post->save();

        return redirect('posts');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        $post->content = $request->content;
        $post->save();

        return redirect('posts');
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('posts');
    }
}
