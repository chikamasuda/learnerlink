@extends('layouts.app')

@section('content')
<img class="fv-pc" src="../img/fv.jpg">
<img class="fv-pd" src="../img/fv-pd.jpg">
<div class="fv-inner text-center col-sm-8 pt-5">
  <p class="matching-text">User list</p>
</div>
<div>
  <form class="text-center mt-4 form" action="{{ url('/search') }}" method="get">
    {{ csrf_field() }}
    <div class="form-group d-flex justify-content-center">
      <input type="text" class="form-control search-form2" name="keyword" placeholder="名前、居住地、言語等で検索">
      <button type="submit" class="btn btn-info ml-1"><i class="fas fa-search"></i></button>
  </form>
</div>
<h2 class="text-center mt-4">検索結果</h2>
<div class="home-container text-center">
  @if(isset($users))
  <ul class="text-center user">
    @foreach($users as $user)
    <li class="user-block mb-4">
      @if($user->image)
      <p class="text-center mb-2">
        <img class="user-image" src="data:image/png;base64,{{ $user->image }}">
      </p>
      @else
      <div class="text-center mb-2">
        <img class="user-image" src="{{ Gravatar::src($user->email, 120) }}" alt="">
      </div>
      @endif
      <div class="user-name">
        {{ $user->name }}<br>
      </div>
      <div class="mb-1">
        <i class="fas fa-map-marker-alt text-info"></i><span class="ml-1">{{ $user->address }}</span><span class="ml-2">{{ $user->sex }}</span>
      </div>
      <div>
        {!! link_to_route('users.show', 'プロフィールをみる',[$user->id],['class'=>'btn btn-sm btn-info mt-1 pl-3 pr-3']) !!}
      </div>
    </li>
    @endforeach
    @if(count($users) === 0)
    <div class="mx-auto">
      <div class="alert-primary alert" role="alert">検索結果は0件です</div>
    </div>
    @endif
  </ul>
  @endif

  @if(!empty($message))
  <div class="text-center">
    <div class="alert-primary alert  mt-3" role="alert">{{ $message }}</div>
  </div>
  @endif
</div>
<div class="text-center side-title-text"><a href="/home" class="mb-5 ml-2 home-back btn btn-info btn-md text-white">ユーザー一覧に戻る</a></div>
@endsection