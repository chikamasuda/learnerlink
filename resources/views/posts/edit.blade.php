@extends('layouts.app')

@section('content')
<div class="edit mb-5 pb-3 post-page">
  <div class="text-center bg-info">
    <h2 class="edit-title text-white">投稿を編集</h2>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group mt-3">
            <label class="post-title">近況をつぶやきましょう。</label>
            <textarea class="form-control" name="content" rows="3">{{ $post->content }}</textarea>
          </div>
          <div class="form-group mb-3 mt-3">
            <label for="">投稿写真</label><br>
            @if ($post->image)
            <div>
              <img src="/storage/posts/{{ $post->image }}" class="mb-4">
            </div>
            @endif
            <input type="file" name="image" accept="image/jpeg,image/gif,image/png">
          </div>
          <div class="text-center">
            <button type="submit" class="btn pl-5 pr-5 btn-info mt-3">投稿を編集する</button>
          </div>
        </form>
        <div class="mb-3 mt-3 text-center">
          <a href="/posts">つぶやき一覧に戻る</a>
        </div>
      </div>
    </div>
  </div>
  @endsection