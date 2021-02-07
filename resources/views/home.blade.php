@extends('layouts.app')

@section('content')
<div class="home-container">
  <img class="fv-pc" src="../img/fv.jpg">
  <img class="fv-pd" src="../img/fv-pd.jpg">
  <div class="fv-inner text-center pt-5">
    <p class="matching-text">User list</p>
    <p class="sub-text">ユーザー一覧</p>
  </div>
  <div>
    <form class="form" action="{{ url('/search') }}" method="get">
      {{ csrf_field() }}
      <div>
        <div class="search-container">
          <div>
            <div class="search-inner">
              <label class="mt-2 mr-2">キーワードから検索</label>
              <div class="search-subinner">
                <input type="text" class="form-control search-form" name="keyword" placeholder="名前、居住地、言語等で検索">
                <button type="submit" class="btn btn-info ml-1 search-button">検索する</button>
              </div>
            </div>
          </div>
        </div>
    </form>
  </div>
  <ul class="text-center user">
    @foreach($users as $user)
    <li class="user-block mb-4">
      @if($user->image)
      <p class="text-center mb-2">
        <img class="user-image" src="/storage/user_images/{{ $user->image }}" alt="">
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
  </ul>
  @endsection
</div>