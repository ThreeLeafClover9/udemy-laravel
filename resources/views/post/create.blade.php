@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('posts.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Enter title">
        <input type="text" name="content" placeholder="Enter content">
        <input type="submit" name="submit" value="submit">
    </form>
@endsection
