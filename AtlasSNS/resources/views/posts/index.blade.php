@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>
<div class="container">
  {!! Form::open(['url' => '/post', 'method' => 'POST']) !!}

  <div class="form-group">
    {{ Form::input('text', 'authorName', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容を入力してください']) }}
  </div>

  <button type="submit" class="btn btn-success pull-right">
    <img src="{{ asset('images/post.png') }}" alt="送信">
  </button>

  {!! Form::close() !!}
</div>









@endsection
