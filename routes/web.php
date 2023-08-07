<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResourceController;
use App\Models\Country;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
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
//    if (Auth::check()) {
//        return "the user is logged in";
//    }
//    $name = 'test';
//    $password = '123456789';
//    if (Auth::attempt(['name' => $name, 'password' => $password])) {
//        return redirect()->intended('/dashboard');
//    }
//    Auth::logout();
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

Route::resource('resource/test', ResourceController::class);

Route::get('/contact', [ResourceController::class, 'contact']);

Route::get('/post/{id}/{name}/{password}', [ResourceController::class, 'showPost']);

Route::get('/insert', function () {
    DB::insert('insert into posts (title, content, user_id) values (?, ?, ?)', ['PHP with Laravel', 'Laravel is the best thing that has happened to PHP', 1]);
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
        'user_id' => 1,
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

Route::get('/users/{id}/post', function ($id) {
    return User::find($id)->post;
});

Route::get('/posts/{id}/user', function ($id) {
    return Post::find($id)->user;
});

Route::get('/posts/{id}', function ($id) {
    $posts = User::find($id)->posts;
    foreach ($posts as $post) {
        echo "{$post}<br>";
    }
});

Route::get('/users/{id}/role', function ($id) {
//    $user = User::find($id);
//    foreach ($user->roles as $role) {
//        echo "{$role}<br>";
//    }
    return User::find($id)->roles()->orderByDesc('id')->get();
});

Route::get('/pivots/{id}', function ($id) {
    $user = User::find($id);
    foreach ($user->roles as $role) {
        echo "{$role->pivot->created_at}<br>";
    }
});

Route::get('/country/{id}/posts', function ($id) {
    $country = Country::find($id);
    foreach ($country->posts as $post) {
        echo "{$post->title}<br>";
    }
});

Route::get('/users/{id}/photos', function ($id) {
    $user = User::find($id);
    foreach ($user->photos as $photo) {
        echo "{$photo->url}<br>";
    }
});

Route::get('/posts/{id}/photos', function ($id) {
    $post = Post::find($id);
    foreach ($post->photos as $photo) {
        echo "{$photo->url}<br>";
    }
});

Route::get('/photos/{id}/imageable', function ($id) {
    return Photo::find($id)->imageable;
});

Route::get('/posts/{id}/tags', function ($id) {
    $post = Post::find($id);
    foreach ($post->tags as $tag) {
        echo "{$tag->name}<br>";
    }
});

Route::get('/tags/{id}/taggable', function ($id) {
    $tag = Tag::find($id);
    foreach ($tag->posts as $post) {
        echo "{$post->title}<br>";
    }
    foreach ($tag->videos as $video) {
        echo "{$video->name}<br>";
    }
});

Route::resource('resource/posts', PostController::class);

Route::get('/dates', function () {
    $date = new DateTime('+1 week');
    echo sprintf("%s<br>", $date->format('m-d-Y'));
    echo sprintf("%s<br>", Carbon::now()->addDays(10)->diffForHumans());
    echo sprintf("%s<br>", Carbon::now()->subMonths(5)->diffForHumans());
    echo sprintf("%s<br>", Carbon::now()->yesterday()->diffForHumans());
});

Route::get('/accessors', function () {
    return User::find(1)->name;
});

Route::get('/mutators', function () {
    Post::find(1)->update([
        'title' => 'WILLIAM'
    ]);
});

//Route::get('/dashboard', function () {
//    $user = Auth::user();
//    return view('dashboard')->with('user', $user);
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/roles', function () {
    return "Middleware role";
})->middleware('role', 'auth');

Route::get('/admin', function () {
//    $user = Auth::user();
//    if ($user->isAdmin()) {
//        return "this user is an administrator";
//    }
    return "you are an administrator because you are seeing this page";
})->middleware('is.admin');
