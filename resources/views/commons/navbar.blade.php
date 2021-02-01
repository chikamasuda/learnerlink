<header>
  @if(Auth::check())
  <nav class="navbar navbar-expand-sm bg-dark navbar-light">
      <h1><a class="navbar logo" href="/home">Learner Link</a></h1>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
        <span class="navbar-toggler-icon navbar-light"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav-bar">
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav">
          <li class="nav-item"><a href="/home" class="nav-right">ユーザー一覧</a></li>
          <li class="nav-item">{!! link_to_route('matching', 'マッチング',[],  ['class'=>'nav-right']) !!}</li>
          <li class="nav-item"><a href="/posts" class="nav-right">つぶやき一覧</a></li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-right dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li class="dropdown-item">{!! link_to_route('users.show', 'プロフィール',['id' => Auth::id()]) !!}</li>
              <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
            </ul>    
          </li>
        </ul>
    </div>
  </nav>
  @else
  <nav class="navbar navbar-expand-sm bg-dark navbar-light">
    <h1><a class="navbar logo" href="/">Learner Link</a></h1>
    
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
      <span class="navbar-toggler-icon"></span>
    </button>
      
      <div class="collapse navbar-collapse" id="nav-bar">
        <ul class="navbar-nav mr-auto"></ul>
        <ul class="navbar-nav">
          <li class="nav-item">{!! link_to_route('signup.get', '新規登録', [], ['class'=>'nav-right']) !!}</li>
          <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class'=>'nav-right']) !!}</li>
          <li class="nav-item">{!! link_to_route('guest', 'かんたんログイン', [], ['class'=>'nav-right']) !!}</li>
        </ul>
      </div>
  </nav>
  @endif
</header>
