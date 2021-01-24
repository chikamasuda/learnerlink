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

    if($request->image != null) {
      $filePath = $request->image->store('public');
      $post->image = str_replace('public/', '', $filePath);
      $post->photo = base64_encode(file_get_contents($request->image));
    }

    $post->save();

    return redirect('posts');
  }

  public function edit($id)
  {
    $post = Post::find($id);

    return view('posts.edit', ['post' => $post]);
  }

  public function update(PostRequest $request)
  {
    $post = Post::find($request->id);
    $post->content = $request->content;

    if($request->image != null) {
      $filePath = $request->image->store('public');
      $post->image = str_replace('public/', '', $filePath);
      $post->photo = base64_encode(file_get_contents($request->image));
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
