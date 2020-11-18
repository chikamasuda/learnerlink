<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <title>LearnerLink</title>
</head>
<body>

<div class="chatPage">
  <header class="header">
  <a href="{{route('matching')}}" class="linkToMatching"></a>
    <div class="chatPartner">
      <div class="chatPartner_img">
      @if($chat_room_user->image)
        <p class="text-center">
          <img class="matching-image mr-3" src="data:image/png;base64,{{ $chat_room_user->image }}">
        </p>
      @else
        <div class="text-center">
          <img class="mr-3 matching-image" src="{{ Gravatar::src($chat_room_user->email, 50) }}" alt="">
        </div>
      @endif
        </div>
        <div class="chatPartner_name">{{ $chat_room_user -> name }}</div>
    </div>
  </header>
  <div class="container">
    <div class="messagesArea messages">
    @foreach($chat_messages as $message)
    <div class="message">
      <div class="text-right">
      @if($message->user_id == Auth::id())
        <div class="mycomment text-left">
          {{$message->message}}
        </div>
      @else
      <div class="text-left">
        @if($chat_room_user->image)
          <span><img class="mr-3 matching-image" src="{{ Gravatar::src($chat_room_user->email, 50) }}" alt=""><img class="matching-image mr-3" src="data:image/png;base64,{{ $chat_room_user->image }}"></span>
        @else
          <span><img class="mr-3 matching-image" src="{{ Gravatar::src($chat_room_user->email, 50) }}" alt=""></span>
        @endif
        <div class="commonMessage">
          {{$message->message}}
        </div>
      </div>
      @endif
      </div>
    </div>
    @endforeach
    </div>
  </div>
  <form class="messageInputForm">
    <div class='container'>
      <input type="text" data-behavior="chat_message" class="messageInputForm_input" placeholder="メッセージを入力...">
    </div>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
var chat_room_id = {{ $chat_room_id }};
var user_id = {{ Auth::user()->id }};
</script>

</body>
</html>


