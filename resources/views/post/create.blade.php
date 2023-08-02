@extends('layouts.layout')

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
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" placeholder="Enter title">
        </div>
        <div>
            <label for="content">Content:</label>
            <input type="text" name="content" id="content" placeholder="Enter content">
        </div>
        <div>
            <input type="file" name="file" id="file">
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection
