@extends('layouts.app')

@section('content')
<div><img class="fv-pc" src="../img/tweet.jpg"></div>
<div><img class="fv-pd" src="../img/tweet-pd.jpg"></div>
<div class="fv-inner text-center col-sm-8 pt-5">
  <p class="matching-text">Tweet list</p>
  <p class="sub-text">つぶやき一覧</p>
</div>
<div class="container">
  <div class="row">
    <aside class="col-sm-4">
      <div class="card post-top">
        <div class="card-header">
          <h3 class="card-title">{{ Auth::user()->name}}</h3>
        </div>
        <div class="card-body">
          @if(Auth::user()->image)
          <p class="text-center">
            <img src="data:image/png;base64,{{ Auth::user()->image }}">
          </p>
          @else
          <div class="text-center pt-3 pb-2">
            <img class="profile-image" src="{{ Gravatar::src(Auth::user()->email, 300) }}" alt="">
          </div>
          @endif
        </div>
      </div>
    </aside>
    <div class="col-sm-8 post-top mb-5">
      <div class="text-center bg-info">
        <h2 class="post-maintitle text-white">つぶやき一覧</h2>
      </div>
      <div class="bg-white post-container">
      <form method="POST" action="{{ route('posts.add') }}" enctype="multipart/form-data">
        @csrf
        <div class="pt-4 ml-4 mr-4">
          <label class="post-title">近況を投稿しましょう</label>
          <textarea class="form-control" name="content" style="white-space: pre-wrap;"></textarea>
          <input type="file" class="mt-3" name="image" accept="image/jpeg,image/gif,image/png">
        </div>
        <div class="text-center">
          <button type="submit" class="btn pl-5 pr-5 btn-info mt-3">投稿する</button>
        </div>
      </form>
      <div class="mt-4 ml-4 mr-4">
        @foreach ($posts as $post)
        <div class="post">
          <div class="d-flex">
            @if ($post->user->image)
            <div><img class="post-image" src="data:image/png;base64,{{ $post->user->image }}"></div>
            @else
            <div><img class="post-image" src="{{ Gravatar::src($post->user->email, 40) }}" alt=""></div>
            @endif
            <div class="post-name text-center ml-2 mr-2">{{ $post->user->name }}</div>
            <small class="post-time">{{ $post->created_at }}</small>
          </div>
          <p class="post-content">{{ $post->content }}</p>
          @if ($post->image)
          <img src="data:image/png;base64,{{ $post->image }}" class="mb-4">
          @endif
          @if($post->user->id == Auth::id())
          <div class="d-flex justify-content-end mb-4">
            <a href="/posts/edit/{{$post->id}}">
              <input class="btn btn-outline-success btn-sm mr-2 pl-4 pr-4" type="submit" value="編集">
            </a>
            <form method="POST" action="{{ route('posts.delete',$post->id) }}" accept-charset="UTF-8">
              @csrf
              <input name="_method" type="hidden" value="DELETE">
              <input class="btn btn-outline-danger btn-sm pl-4 pr-4" type="submit" value="削除">
            </form>
          </div>
          @endif
          @endforeach
        </div>
        <div class="pt-4 pb-5">{{ $posts->links('pagination::bootstrap-4') }}</div>
      </div>
    </div>
  </div>
</div>
  @endsection