@extends('layouts.login')

@section('content')

{{-- ログインユーザーのアイコン --}}
<img src="{{ asset('images/' . trim(Auth::user()->images ?? 'default.png')) }}" alt="ユーザーアイコン" width="50">

{{-- バリデーションエラーメッセージ --}}
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
<button type="submit" class="btn">
  <img src="{{ asset('images/post.png') }}" alt="送信" style="height: 30px;">
</button>
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
{!! Form::close() !!}

{{-- 投稿一覧 --}}
<h3>投稿一覧</h3>
@if ($posts->isEmpty())
<p>投稿はまだありません。</p>
@else
<ul>
  @foreach ($posts as $post)
  <li style="margin-bottom: 15px; border-bottom: 1px solid #ccc; padding: 10px;">
    {{-- ユーザーアイコン --}}
    <img src="{{ asset('images/' . ($post->user->images ?? 'default.png')) }}" alt="ユーザーアイコン"
      style="width:40px; height:40px; border-radius:50%; margin-right:10px;">

    {{-- ユーザー名 --}}
    <strong>{{ $post->user->username ?? '匿名' }}:</strong>

    {{-- 投稿内容 --}}
    <span class="post-content">{{ $post->post }}</span>

    {{-- 投稿日時 --}}
    <small>（{{ $post->created_at->format('Y-m-d H:i') }}）</small>

    {{-- 編集ボタン（自分の投稿のみ） --}}
    @if ($post->user_id === Auth::id())
    <div class="content">
      <a class="js-modal-open" href="#" data-post="{{ $post->post }}" data-post_id="{{ $post->id }}">
        <img src="{{ asset('images/edit.png') }}" alt="編集" class="edit-img">
      </a>

      {{-- 消去ボタン --}}
      {!! Form::open(['url' => '/post/' . $post->id . '/delete', 'method' => 'POST', 'style' => 'display:inline;']) !!}
      <button type="submit" onclick="return confirm('本当に削除しますか？')" class="delete-btn">
        <img src="{{ asset('images/trash-h.png') }}" alt="消去" class="delete-img">
      </button>
    </div>

    {!! Form::close() !!}
    @endif
  </li>
  @endforeach
</ul>
@endif

{{-- 編集用モーダル --}}
<div class="modal js-modal" style="display:none;">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    {!! Form::open(['url' => '', 'method' => 'POST', 'id' => 'editPostForm']) !!}
    @csrf
    @method('PUT')

    <div class="modal__form-wrapper">
      {{-- テキストエリア --}}
      <textarea name="post" class="modal_post" required maxlength="150"></textarea>

      {{-- 投稿ID（hidden） --}}
      <input type="hidden" name="id" class="modal_id">

      {{-- 送信ボタン（画像付き） --}}
      <button type="submit" class="edit-submit-btn">
        <img src="{{ asset('images/edit.png') }}" alt="編集" style="height: 30px;">
      </button>
    </div>

    {!! Form::close() !!}

    {{-- 閉じるリンク --}}
    <a class="js-modal-close" href="#"></a>
  </div>
</div>
@endsection
