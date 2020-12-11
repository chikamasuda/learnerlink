@extends('layouts.app')

@section('content')

<div><img class="fv-pc" src="../img/fv.jpg"></div>
<div><img class="fv-pd" src="../img/fv-pd.jpg"></div>
<div class="fv-inner text-center col-sm-8 pt-5">
  <p class="matching-text">User list</p>
</div>
<div class="home-container mb-3">
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
  </ul>
  @endsection
</div>