@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>


{{-- ログインユーザーのアイコン --}}
<img src="{{ asset('images/' . trim(Auth::user()->images ?? 'default.png')) }}" alt="ユーザーアイコン" width="50">


{{-- 投稿フォーム --}}
{!! Form::open(['url' => '/post', 'method' => 'POST']) !!}

<div class="form-group">
  {{ Form::textarea('post', null, [
          'required',
          'class' => 'form-control',
          'placeholder' => '投稿内容を入力してください',
          'maxlength' => 150
      ]) }}
</div>

{{-- 画像ボタンとして送信 --}}
<button type="submit" class="btn">
  <img src="{{ asset('images/post.png') }}" alt="送信" style="height: 30px;">
</button>

{{-- 送信が成功したらメッセージ --}}
@if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

{!! Form::close() !!}
</div>
@endsection
