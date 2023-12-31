<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "its working";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "I am the method that creates stuff :)";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "this is the show method yayyyyy {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function contact()
    {
        $people = ['Edwin', 'Jose', 'James', 'Peter', 'Maria'];
        return view('contact')->with('people', $people);
    }

    public function showPost($id, $name, $password)
    {
//        return view('post', ['id' => $id]);
        return view('post')
            ->with('id', $id)
            ->with('name', $name)
            ->with('password', $password);
    }
}
