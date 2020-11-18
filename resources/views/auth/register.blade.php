@extends('layouts.app')

@section('content')
<div class="signup-page signup mb-5 mt-5">
  <div class="text-center bg-light">
      <h2 class="signup-title">アカウント作成</h2>
  </div>
<div class="row">
  <div class="col-sm-6 offset-sm-3">
    <form class="form" method="POST" action="{{ route('signup.post') }}" enctype="multipart/form-data">
    　 　{{ csrf_field() }}
    <div class="form-group mb-3">
      <label>名前</label>
      <input type="text" name="name" class="form-control">
    </div>
    
    <div class="form-group mb-3">
      <label>メールアドレス</label>
      <input type="email" name="email" class="form-control">
    </div>
    
    <div>
      <label>パスワード</label>
      <em>6文字以上入力してください</em>
      <input type="password" name="password" class="form-control">
    　</div>
    <div class="form-group mb-3">
      <label>確認用パスワード</label>
      <input type="password" name="password_confirmation" class="form-control">
    </div>
    <div class="form-group mb-3">
      <div><label>性別</lavel></div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" name="sex" value="男性" type="radio" id="inlineRadio1" checked>
        <label class="form-check-label" for="inlineRadio1">男性</label>
      </div>
      <div class="form-check form-check-inline">
        <input class="form-check-input" name="sex" value="女性" type="radio" id="inlineRadio2">
        <label class="form-check-label" for="inlineRadio2">女性</label>
      </div>
    </div>
    <div class="form-group mb-3">
      <label>居住地</label>
      <input type="text" name="address" class="form-control">
    </div>
    <div class="form-group">
      <label>学んでいる言語</label>
      <input type="text" name="language" class="form-control">
    </div>
　　<div class="form-group">
    <label>自己紹介</label>
    <textarea class="form-control" name="self_introduction" rows="7"></textarea>
　　</div> 
    
    <div class="text-center">
    <button type="submit" class="btn btn-info btn-lg">新規登録する</button>
    </div>
    <div class="linkToLogin mt-3 mb-5 text-center">
      <a href="{{ route('login') }}" class="">ログインはこちら</a>
    </div>
    </div>
  </form> 
  </div>
</div>
</div>
@endsection
