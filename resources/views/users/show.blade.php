@extends('layouts.app')

@section('content')

<div class='usershowPage'>
    <div class='show-container mb-5 pb-5'>
      <div class='userInfo'>
      @if($user->image)
        <p class="text-center">
          <img class="user-image mt-3" src="data:image/png;base64,{{ $user->image }}">
        </p>
      @else
        <div class="text-center pt-3 pb-2">
          <img class="mr-2 user-image" src="{{ Gravatar::src($user->email, 120) }}" alt="">
        </div>
      @endif
      <div class='userInfo_name'>{{ $user -> name }}</div>
      <div class="text-center">@include('like.like_button', ['user' => $user])</div>
      <div class='userAction'>
      @if ($user->id == Auth::id())
        <div class="userAction_edit userAction_common text-center">
          <a href="/users/edit/{{$user->id}}">
            <i class="fas fa-edit fa-2x"></i>
          </a>
          <span>情報を編集</span>
      @endif
        </div>
      </div>
      <div class='profile profile-top userInfo_selfIntroduction row'> 
        <div class="text-info col-md-4">自己紹介文</div>
        <div class="mt-1 selfIntroduction col-md-8">{{ $user -> self_introduction }}</div>
      </div>
      <div class='profile d-flex flex-row justify-content-start'>
        <div class="text-info col-md-4">性別</div><div class="col-md-8">{{ $user -> sex }}</div>
      </div>
      <div class='profile d-flex flex-row justify-content-start'>
        <div class=" mt-3 text-info col-md-4">居住地</div><div class="mt-3 col-md-8">{{ $user -> address }}</div>
      </div>
      <div class='profile d-flex flex-row justify-content-start profile-bottom'>
        <div class=" mt-3 text-info col-md-4">学んでいる言語</div><div class="mt-3 col-md-8">{{ $user -> language }}</div>
      </div>
      
      <div class="text-center mt-5"><a href="/home" class="mt-5 ml-2 home-back"><i class="fas fa-angle-double-left mr-2"></i>ユーザー一覧に戻る</a></div>
  </div>
</div>

@endsection

<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>