@extends('layouts.login')
@section('content')

<div style="display: flex; align-items: flex-start;">
  {{-- 検索フォーム --}}
  <form action="{{ url('/search') }}" method="GET">
    <input type="text" name="username" placeholder="ユーザー名" value="{{ $keyword }}">
    <button type="submit" class="btn">
      <img src="{{ asset('images/search.png') }}" alt="送信" style="height: 30px;">
    </button>
  </form>
</div>

{{-- 検索ワードがあるときだけ表示 --}}
@if(!empty($keyword))
<p>検索ワード：{{ $keyword }}</p>
@endif

{{-- ユーザー一覧表示 --}}
@if($users->isNotEmpty())
<ul>
  @foreach($users as $user)
  <li style="margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
    {{-- ユーザーアイコン --}}
    <img src="{{ asset('images/' . $user->images) }}"
      alt="{{ $user->username }}のアイコン"
      style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">

    {{-- ユーザー名 --}}
    <span>{{ $user->username }}</span>

    {{-- フォロー・解除ボタン --}}
    @if(Auth::user()->isFollowing($user->id))
    <form action="{{ route('unfollow', $user->id) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">フォロー解除</button>
    </form>
    @else
    <form action="{{ route('follow', $user->id) }}" method="POST" style="display:inline;">
      @csrf
      <button type="submit" class="btn btn-primary">フォローする</button>
    </form>
    @endif
  </li>
  @endforeach
</ul>
@else
<p>該当するユーザーはいません。</p>
@endif

@endsection
