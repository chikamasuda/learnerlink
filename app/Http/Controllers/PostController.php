<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
  public function index()
  {
    $posts = Post::all();
    $posts = Post::orderBy('created_at', 'desc')->paginate(5);
    return view('posts.index', ['posts' => $posts]);
  }

  public function add(PostRequest $request)
  {
    $post = new Post;
    $post->user_id = Auth::user()->id;
    $post->content = $request->content;
    $originalImg = $request->image;

    if($originalImg != null) {
      $filePath = $originalImg->store('posts');
      $post->image = str_replace('posts', '', $filePath);
    }

    $post->save();

    return redirect('posts');
  }

  public function edit($id)
  {
    $post = Post::find($id);
    if ($post === null) {
      abort(404);
    }

    return view('posts.edit', ['post' => $post]);
  }

  public function update(PostRequest $request)
  {
    $post = Post::find($request->id);
    $post->content = $request->content;
    $originalImg = $request->image;

    if($originalImg != null) {
      $filePath = $originalImg->store('posts');
      $post->image = str_replace('posts/', '', $filePath);
    }
    
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
