@extends('layouts.login')

@section('content')
<h2>機能を実装していきましょう。</h2>


{{-- ログインユーザーのアイコン --}}
<img src="{{ asset('images/' . trim(Auth::user()->images ?? 'default.png')) }}" alt="ユーザーアイコン" width="50">

{{-- 投稿フォームの直前か直後に、エラーメッセージを表示するコードを追加(バリデーション) --}}
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

{{-- 投稿フォーム --}}
{!! Form::open(['url' => '/post', 'method' => 'POST']) !!}

<div class="form-group">
  {{ Form::textarea('post', old('post'), [
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


{{-- 投稿内容を画面に表示 --}}
<h3>投稿一覧</h3>

@if ($posts->isEmpty())
<p>投稿はまだありません。</p>
@else
<ul>
  @foreach ($posts as $post)

  {{-- 投稿欄の枠組みで囲う --}}
  <li style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px; border-bottom: 1px solid #ccc; padding: 10px;">

  <li style="margin-bottom: 15px;">
    {{-- ユーザーアイコン --}}
    <img src="{{ asset('images/' . ($post->user->images ?? 'default.png')) }}"
      alt="ユーザーアイコン"
      style="width:40px; height:40px; border-radius:50%; margin-right:10px; vertical-align:middle;">

    {{-- ユーザー名 --}}
    <strong>{{ $post->user->username ?? '匿名' }}:</strong>

    {{-- 投稿内容 --}}
    {{ $post->post }}

    {{-- 投稿日時 --}}
    <small>（{{ $post->created_at->format('Y-m-d H:i') }}）</small>


    {{-- 自分の投稿なら「編集」リンク」を表示 --}}
    @if ($post->user_id === Auth::id())
    <div style="min-width: 60px; text-align: right;">
      <a href="/post/{{ $post->id }}/edit">
        <img src="{{ asset('images/edit.png') }}" alt="編集" style="height: 30px;">
        　 </a>

      {{-- 消去処理の表示 --}}
      {!! Form::open(['url' => '/post/' . $post->id . '/delete', 'method' => 'POST', 'style' => 'display:inline;']) !!}
      <button type="submit" onclick="return confirm('本当に削除しますか？')" style="color:red; border:none; background:none; cursor:pointer;">
        <img src="{{ asset('images/trash-h.png') }}" alt="消去" style="height: 30px;">
      </button>
      {!! Form::close() !!}
      @endif

  </li>
  @endforeach

</ul>
@endif

@endsection
