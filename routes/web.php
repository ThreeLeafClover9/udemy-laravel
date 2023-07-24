<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return "Hi about page";
});

Route::get('/post/{id}/{name}', function ($id, $name) {
    return "This is post number {$id} {$name}";
});

//Route::get('/admin/posts/example', array('as' => 'admin.home', function () {
//    $url = \route('admin.home');
//    return "this url is " . $url;
//}));
Route::get('/admin/posts/example', function () {
    $url = \route('admin.home');
    return "this url is {$url}";
})->name('admin.home');

Route::resource('posts', PostsController::class);

Route::get('/contact', [PostsController::class, 'contact']);

Route::get('/post/{id}/{name}/{password}', [PostsController::class, 'showPost']);
