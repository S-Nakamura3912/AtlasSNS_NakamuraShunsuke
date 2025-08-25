@extends('layouts.login')
@section('content')

{{-- ユーザー検索フォーム --}}
{!! Form::open(['url' => '/post', 'method' => 'POST']) !!}

{{ Form::label('') }}
{{ Form::text('username',null,['placeholder' => 'ユーザー名']) }}

<button type="submit" class="btn">
  <img src="{{ asset('images/search.png') }}" alt="送信" style="height: 30px;">
</button>


{!! Form::close() !!}
@endsection
