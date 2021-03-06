@extends('layouts.app')

@section('content')
<div class="mt-5 sign-in">
    <div class="text-center mb-4 mt-3 bg-light">
        <h2 class="sign-in-title">ログイン</h2>
    </div>

    <div class="row" style="margin:0;">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::open(['route' => 'login.post']) !!}
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group mt-4">
                {!! Form::label('password', 'パスワード') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <div class="text-center">
                {!! Form::submit('ログインする', ['class' =>'btn btn-info btn-lg mt-4']) !!}
            </div>
            <div class="text-center">
                {!! link_to_route('guest', 'ゲストログイン', [], ['class'=>'pl-2 pr-2 btn btn-danger btn-lg mt-4']) !!}
            </div>
            {!! Form::close() !!}

            <div class="text-center mt-3">
                {!! link_to_route('signup.get', 'アカウント作成はこちら',[], ['class' =>'text-info']) !!}
            </div>
        </div>
    </div>
</div>
@endsection