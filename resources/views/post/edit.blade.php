@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
        @method('PUT')
        @csrf
        <input type="text" name="title" placeholder="Enter title" value="{{ $post->title }}">
        <input type="text" name="content" placeholder="Enter content" value="{{ $post->content }}">
        <input type="submit" name="submit" value="update">
    </form>
    <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
        @method('DELETE')
        @csrf
        <input type="submit" value="delete">
    </form>
@endsection
