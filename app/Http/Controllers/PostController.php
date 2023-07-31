<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $posts = Post::all();
        $posts = Post::admin()->orderBy('id')->get();
        return view('post.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
//        $validated = $request->validate([
//            'title' => 'required',
//            'content' => 'required'
//        ]);
        $validated = $request->validated();
        Post::create([
            ...$validated,
            'user_id' => 1
        ]);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('post.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Post::findOrFail($id)
            ->update($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index');
    }
}
