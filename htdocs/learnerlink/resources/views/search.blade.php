@extends('layouts.app')

@section('content')
  <h2 class="text-center search-title">検索結果</h2>
    <div class="search-container text-center">
  　   <form action="{{ url('/search') }}" method="post">
          {{ csrf_field() }}
          {{ method_field('get') }}
        <div class="sidebar text-left">
          <div class="side-title text-info">SEARCH</div>
          <div class="form-group side-title-text search">
            <label>名前</label>
            <div class="d-flex flex-row">
              <input type="text" name ="name" placeholder="名前を入力" class="form-control mr-1">
              <button type="submit" class="btn btn-info mr-1"><i class="fas fa-search"></i></button>
            </div>
          </div>
          <div class="form-group side-title-text mt-2 mb-2">
            <label>性別</label>
            <div class="d-flex flex-row">
            <select class="form-control mr-1" name="sex">
              <option selected value="0">選択</option>
              <option value="1">男</option>
              <option value="2">女</option>
            </select>
            <button type="submit" class="btn btn-info mr-1"><i class="fas fa-search"></i></button>
            </div>
          </div>
          <div class="form-group side-title-text search pt-3">
            <label>言語</label>
            <div class="d-flex flex-row">
              <input type="text" name ="language" placeholder="言語を入力" class="form-control mr-1">
              <button type="submit" class="btn btn-info mr-1"><i class="fas fa-search"></i></button>
            </div>
          </div>
          <div class="form-group side-title-text search pt-4 mb-4">
            <label>居住地</label>
            <div class="d-flex flex-row">
              <input type="text" name ="address" placeholder="居住地を入力" class="form-control mr-1">
              <button type="submit" class="btn btn-info mr-1"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
      </form>
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
            {!! link_to_route('users.show', 'プロフィールをみる',[$user->id],['class'=>'btn btn-sm btn-info mb-3 mt-1 pl-3 pr-3']) !!}
          </div>
        </li> 
      @endforeach 
      @if(count($users) === 0)
        <div class="text-center user">
          <div class="alert-1 alert-primary alert" role="alert">検索結果は0件です</div>
        </div>
      @endif
    　</ul>
      @endif
        
      @if(!empty($message))
        <div class="text-center user">
          <div class="alert-2 alert-primary alert" role="alert">{{ $message }}</div>
        </div>
      @endif
        </div>
        <div class="text-center side-title-text"><a href="/home" class="mt-3 mt-5  ml-2 home-back btn btn-info btn-md text-white">ユーザー一覧に戻る</a></div>
      @endsection 
