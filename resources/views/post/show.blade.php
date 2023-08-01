@extends('layouts.app')

@section('content')
    <h1><a href="{{ route('posts.edit', ['post' => $post->id]) }}">{{ $post->title }}</a></h1>
    <div>
        <img src="/{{ $post->path }}" alt="" height="100">
    </div>
@endsection
