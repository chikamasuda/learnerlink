@extends('layouts.app')

@section('content')
<div><img class="fv-pc" src="../img/matching.jpg"></div>
<div><img class="fv-pd" src="../img/match-pd.jpg"></div>
<div class="fv-inner text-center col-sm-8 pt-5">
  <p class="matching-text">Tweet list</p>
  <p class="sub-text">つぶやき一覧</p>
</div>
<div class="edit mb-5 pb-3 post-page">
  <div class="text-center bg-info">
    <h2 class="edit-title text-white">Tweets</h2>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <form method="POST" action="{{ route('posts.add') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="form-group mt-3 mb-3">
            <label class="post-title">近況を投稿しましょう</label>
            <textarea class="form-control" name="content" rows="3"></textarea>
            <button type="submit" class="btn pl-5 pr-5 btn-info mt-2">投稿する</button>
          </div>
        </form>
        <div class="mt-4">
          @foreach ($posts as $post)
          <div class="d-flex post">
            @if ($post->user->image)
            <div class="text-center"><img class="matching-image" src="data:image/png;base64,{{ $post->user->image }}"></div>
            @endif
            <div class="post-name text-center ml-2">{{ $post->user->name }}</div>
          </div>
          <div class="post-content">{{ $post->content }}</div>
          <div class="mb-3 mt-1 d-flex justify-content-end">
            <a href="/posts/edit/{{$post->id}}">
              <input class="btn btn-outline-success mt-1 btn-sm mr-2" type="submit" value="編集">
            </a>
            <form method="POST" action="{{ route('posts.delete',$post->id) }}" accept-charset="UTF-8">
              {{ csrf_field() }}
              <input name="_method" type="hidden" value="DELETE">
              <input class="btn btn-outline-danger mt-1 btn-sm" type="submit" value="削除">
            </form>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @endsection