@extends('layouts.app')


@section('content')
<div class="fv row">
  <div class="top-inner text-center col-sm-8">
    <p class="fv-maintext">LearnerLink</p> 
    <p class="fv-subtext font-weight-bold">LearnerLinkは、プログラミングの学習仲間を<br>探す人のためのマッチングサービスです。</p>
      {!! link_to_route('signup.get', '新規登録をする', [], ['class' => 'btn btn-lg btn-info mt-2']) !!}
  </div>
@endsection
</div>

