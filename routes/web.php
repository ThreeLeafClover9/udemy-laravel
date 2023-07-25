<?php

use App\Http\Controllers\PostsController;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
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

Route::get('/insert', function () {
    DB::insert('insert into posts (title, content) values (?, ?)', ['PHP with Laravel', 'Laravel is the best thing that has happened to PHP']);
});

Route::get('/select', function () {
    $posts = DB::select('select * from posts where id = ?', [1]);
    return $posts;
});

Route::get('/all', function () {
    $posts = Post::all();
    return $posts;
});

Route::get('/find', function () {
    $post = Post::find(1);
    return $post;
});

Route::get('/where', function () {
    $posts = Post::where('id', 1)->orderByDesc('id')->take(1)->get();
    return $posts;
});

Route::get('/find-or-fail', function () {
    $post = Post::findOrFail(0);
    return $post;
});

Route::get('/first-or-fail', function () {
    $post = Post::where('is_admin', '<', 50)->firstOrFail();
    return $post;
});

//Route::get('/create', function () {
//    $post = new Post();
//    $post->title = 'New Eloquent title insert';
//    $post->content = 'Wow eloquent is really cool, look at this content';
//    $post->save();
//});
Route::get('/create', function () {
    Post::create([
        'title' => 'the create method',
        'content' => 'WOW I\'m learning a lot with Edwin Diaz',
    ]);
});

//Route::get('/update', function () {
//    $affected = DB::update('update posts set title = "Update title" where id = ?', [1]);
//    return $affected;
//});
//Route::get('/update', function () {
//    $post = Post::find(1);
//    $post->title = 'New Eloquent title insert 2';
//    $post->content = 'Wow eloquent is really cool, look at this content 2';
//    $post->save();
//});
Route::get('/update', function () {
    Post::where('id', 1)
        ->where('is_admin', 0)
        ->update([
            'title' => 'NEW PHP TITLE',
            'content' => 'I love my instructor Edwin'
        ]);
});

//Route::get('/delete', function () {
//    $deleted = DB::delete('delete from posts where id = ?', [1]);
//    return $deleted;
//});
//Route::get('/delete', function () {
//    $post = Post::find(1);
//    $post->delete();
//});
Route::get('/delete', function () {
    Post::destroy(1);
    Post::destroy([4, 5]);
    Post::where('is_admin', 0)->delete();
});

Route::get('/with-trashed', function () {
    return Post::withTrashed()->where('is_admin', 0)->get();
});

Route::get('/only-trashed', function () {
    return Post::onlyTrashed()->where('is_admin', 0)->get();
});

Route::get('/restore', function () {
    Post::withTrashed()->where('is_admin', 0)->restore();
});

Route::get('/force-delete', function () {
    Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
});
