@extends('layouts.layout')

@section('content')
    <ul>
        @foreach($posts as $post)
            <li><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>
@endsection
