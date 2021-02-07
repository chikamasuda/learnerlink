@extends('layouts.app')

@section('content')
<div><img class="fv-pc" src="../img/matching.jpg"></div>
<div><img class="fv-pd" src="../img/match-pd.jpg"></div>
<div class="fv-inner text-center col-sm-8 pt-5">
  <p class="matching-text">Matching</p>
  <p class="sub-text">マッチング</p>
</div>
<div class="container">
  <div class="row">
    <aside class="col-sm-4">
      <div class="card matching-tab">
        <div class="card-header">
          <h3 class="card-title">{{ Auth::user()->name}}</h3>
        </div>
        <div class="card-body">
          @if(Auth::user()->image)
          <p class="text-center">
            <img class="profile-image" src="/storage/user_images/{{ Auth::user()->image }}" alt="">
          </p>
          @else
          <div class="text-center pt-3 pb-2">
            <img class="profile-image" src="{{ Gravatar::src(Auth::user()->email, 300) }}" alt="">
          </div>
          @endif
        </div>
      </div>
    </aside>
    <div class="col-sm-8 mb-5">
      <ul class="nav nav-tabs nav-justified mb-3 matching-tab">
        <li class="nav-item"><a href="{{ route('matching') }}" class="nav-link {{ Request::is('matching') ? 'active' : '' }}">マッチング成立</a></li>
        <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link {{ Request::is('index') ? 'active' : '' }}">いいねされてる</a></li>
      </ul>
      <div class="mt-3 active" id="#matching">
        <div class="matchingNum text-info mt-4">{{ $match_users_count }}人とマッチングしています</div>
        <h2 class="pageTitle"><i class="fa fa-l fa-handshake mr-2"></i>マッチング成立一覧</h2>
        <div class="matchingList mb-3">
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
              <button type="submit" class="btn btn-md btn-info pt-2 pb-2 pl-4 pr-4">チャット</button>
            </form>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
@endsection