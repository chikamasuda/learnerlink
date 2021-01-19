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
          {{ csrf_field() }}
          <div class="form-group mt-3">
            <label class="post-title">近況をつぶやきましょう。</label>
            <textarea class="form-control" name="content" rows="3">{{ $post->content }}</textarea>
            <button type="submit" class="btn pl-5 pr-5 btn-info mt-2">投稿を編集する</button>
          </div>
        </form>
        <div class="mb-3 mt-2 text-center">
          <a href="/posts">つぶやき一覧に戻る</a>
        </div>
      </div>
    </div>
  </div>
@endsection