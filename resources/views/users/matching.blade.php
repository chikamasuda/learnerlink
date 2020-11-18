@extends('layouts.app')

@section('content')
<div class="fv-pc"><img src="../img/fv.jpg"></div>
<div class="fv-pd"><img src="../img/fv-pd.jpg"></div>
<div class="fv-inner text-center col-sm-8 pt-5">
  <p class="matching-text">Matching</p>
</div>
<div class="container">
  <ul class="nav nav-tabs nav-justified mb-3 mt-5">
    <li class="nav-item"><a href="{{ route('matching') }}" class="nav-link {{ Request::is('matching') ? 'active' : '' }}">マッチング成立</a></li>
    <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link {{ Request::is('index') ? 'active' : '' }}">いいねされてる</a></li>
  </ul>
  <div class="mt-3 active" id="#matching">
    <div class="matchingNum text-info">{{ $match_users_count }}人とマッチングしています</div>
    <h2 class="pageTitle">マッチングした人一覧</h2>
    <div class="matchingList">
      @foreach( $matching_users as $user)
      <div class="matchingPerson">
        @if($user->image)
        <div class="text-center">
          <img class="matching-image mr-2" src="data:image/png;base64,{{ $user->image }}">
        </div>
        @else
        <div class="text-center">
          <img class="mr-2 matching-image" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        @endif
        <div class="matchingPerson_name">{{ $user->name }}</div>
        <form method="POST" action="{{ route('chat.show') }}">
          {{ csrf_field() }}
          <input name="user_id" type="hidden" value="{{$user->id}}">
          <button type="submit" class="chatForm_btn btn-block mb-5">チャットを開く</button>
        </form>
      </div>
      @endforeach
    </div>
  </div>
</div>
</div>
</div>
</div>
@endsection