@if (Auth::id() != $user->id)
  @if (Auth::user()->is_like($user->id))
    {!! Form::open(['route' => ['user.dislike',$user->id], 'method' => 'delete']) !!}
      {!! Form::submit('いいねを取り消す', ['class' => "btn btn-danger user-button mb-3 dislike" ]) !!}
    {!! Form::close() !!}
 
  @else
    {!! Form::open(['route' => ['user.like',$user->id]]) !!}
      {!! Form::submit('いいね！', ['class' => "btn btn-info user-button mb-3 like"]) !!}
    {!! Form::close() !!}
  @endif
@endif   
  