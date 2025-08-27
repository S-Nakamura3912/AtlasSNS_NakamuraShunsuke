@extends('layouts.login')
@section('content')

<div style="display: flex; align-items: flex-start;">
  {{-- 検索フォーム --}}
  <form action="{{ url('/search') }}" method="GET">
    <input type="text" name="username" placeholder="ユーザー名">
    <button type="submit" class="btn">
      <img src="{{ asset('images/search.png') }}" alt="送信" style="height: 30px;">
    </button>
  </form>

  {{-- 検索が実行された時だけ表示 --}}
  @if(!empty($keyword))
  <p>検索ワード：</p>
  @endif

  @if($users->isNotEmpty())
  <ul>
    @foreach($users as $user)
    {{-- ユーザーアイコン --}}
    <li>
      <img src="{{ asset('images/' . $user->images) }}"
        alt="{{ $user->username }}のアイコン"
        style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
    </li>

    <li>{{ $user->username }}</li>
    @endforeach
  </ul>
  @else
  <p>該当するユーザーはいません。</p>
  @endif

</div>
@endsection
