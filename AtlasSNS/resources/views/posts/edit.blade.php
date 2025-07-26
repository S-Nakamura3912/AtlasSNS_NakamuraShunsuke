@extends('layouts.login')

@section('content')
<h2>投稿を編集</h2>

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

{!! Form::open(['url' => '/post/' . $post->id . '/update', 'method' => 'POST']) !!}
<div class="form-group">
  {{ Form::textarea('post', old('post', $post->post), [
          'required',
          'class' => 'form-control',
          'maxlength' => 150
      ]) }}
</div>
<button type="submit" class="btn btn-primary">更新</button>
{!! Form::close() !!}
@endsection
