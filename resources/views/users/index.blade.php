@extends('layouts.app')

@section('content')
  <div><img class="fv-pc" src="../img/matching.jpg"></div>
  <div><img  class="fv-pd" src="../img/match-pd.jpg"></div>
  <div class="fv-inner text-center col-sm-8 pt-5">
    <p class="matching-text">Matching</p> 
  </div>
  <div class="container">
    <ul class="nav nav-tabs nav-justified mb-3 mt-5">
      <li class="nav-item"><a href="{{ route('matching') }}" class="nav-link {{ Request::is('matching') ? 'active' : '' }}">マッチング成立</a></li>
      <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link {{ Request::is('index') ? 'active' : '' }}">いいねされてる</a></li>
    </ul>
      
      <div class="active" id="#matching">
        <div class="matchingNum text-info mt-3">{{ $like_users_count }}人にいいねされてます</div>
        <h2 class="pageTitle">いいねされた人一覧</h2>
        <div class="matchingList mb-5">
          @foreach( $like_users as $user)
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
          <form>
            {{ csrf_field() }}
            {!! link_to_route('users.show', 'プロフィール',[$user->id],['class'=>'btn btn-md btn-info pt-2 pb-2 mt-3']) !!}
          </form>
          </div>
         @endforeach
        </div>
      </div>
@endsection
    </div>
  </div>
  </div>
</div>