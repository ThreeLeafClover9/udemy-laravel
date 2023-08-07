<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index(Request $request)
    {
//        $request->session()->put('edwin', 'master instructor');
//        $value = $request->session()->get('edwin');
//        session(['edwin' => 'your teacher']);
//        $value = session('edwin');
//        $request->session()->forget('edwin');
//        $request->session()->flush();
//        $request->session()->flash('message', 'Post has been created');
//        $request->session()->reflash();
//        $request->session()->keep('message');
        $user = Auth::user();
        return view('dashboard')->with('user', $user);
    }
}
