@extends('layouts.app')

@section('content')

<div class="mt-5 sign-in">
    <div class="text-center mb-4 mt-3 bg-light">
        <h2 class="sign-in-title">ゲストログイン</h2>
    </div>
    
    <div class="row" style="margin:0;">
        <div class="col-sm-6 offset-sm-3">
            <form class="form" method="POST" action="{{ route('login.post') }}">
    　 　         {{ csrf_field() }}
    　 　         
                <div class="form-group">
                    <label>メールアドレス</label>
                    <input type="email" name="email" class="form-control" value= "test@gmail.com">
                </div>
                
                <div class="form-group mt-4">
                    <label>パスワード</label>
                    <input type="password" name="password" class="form-control" value= "test-guestuser">
                </div>
                
                <div class="text-center mt-4">
                    {!! Form::open(['route' => ['guest',Auth::id()], 'method' => 'authenticate']) !!}
                    {!! Form::submit('ゲストログイン', ['class' => "btn btn-lg btn-danger"]) !!}
                    {!! Form::close() !!}
                </div>
            </form>
        </div>
    </div>
</div>    
@endsection