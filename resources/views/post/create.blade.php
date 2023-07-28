@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <form method="post" action="{{ route('posts.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Enter title">
        <input type="text" name="content" placeholder="Enter content">
        <input type="submit" name="submit" value="submit">
    </form>
@endsection
