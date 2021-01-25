@extends('layouts.app')
@section('content')
<div class="edit mb-5">
  <div class="text-center mt-5 bg-light">
    <h2 class="edit-title">プロフィールを編集</h2>
  </div>
  <div class="row" style="margin:0">
    <div class="col-sm-6 offset-sm-3">
      <form class="form" method="POST" action="/users/update/{{ $user->id }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3 mt-3">
          <label for="">プロフィール写真</label><br>
          @if ($user->image)
          <p>
            <img class="user-image" src="data:image/png;base64,{{ $user->image }}" alt="avatar">
          </p>
          @endif
          <input type="file" name="image" accept="image/jpeg,image/gif,image/png">
        </div>
        <div class="form-group mb-3">
          <label>名前</label>
          <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="form-group mb-3">
          <label>メールアドレス</label>
          <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="form-group mb-3">
          <div><label>性別</label></div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="sex" value="男性" type="radio" id="inlineRadio1" @if(old('sex',"$user->sex")!='女性')checked="checked"@endif>
            <label class="form-check-label" for="inlineRadio1">男性</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="sex" value="女性" type="radio" id="inlineRadio2" @if(old('sex',"$user->sex")=='女性')checked="checked"@endif>
            <label class="form-check-label" for="inlineRadio2">女性</label>
          </div>
        </div>
        <div class="form-group mb-3">
          <label>居住地</label>
          <input type="text" name="address" class="form-control" value="{{ $user->address }}">
        </div>
        <div class="form-group">
          <label>学んでいる言語</label>
          <input type="text" name="language" class="form-control" value="{{ $user->language }}">
        </div>
        <div class="form-group mt-3">
          <label>自己紹介</label>
          <textarea class="form-control" name="self_introduction" rows="7">{{ $user->self_introduction }}</textarea>
        </div>
        <div class="text-center mt-3">
          <button type="submit" class="btn submitBtn btn-lg btn-info mb-3">プロフィールを変更する</button>
        </div>
      </form>
      <div class="text-center">
        {!! Form::open(['route' => ['users.delete', $user->id], 'method' => 'delete']) !!}
        {!! Form::submit('アカウントを削除する', ['class' => "delete-link mb-4 btn btn-danger btn-lg pl-4 pr-4"]) !!}
        {!! Form::close() !!}
      </div>
      <div class="text-center mb-5">
        {!! link_to_route('users.show', '前の画面に戻る',[$user->id]) !!}
      </div>
    </div>
  </div>
</div>
@endsection