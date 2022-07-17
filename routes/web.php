<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $posts = Post::when(request('search'), function ($q, $search) {
        $q->where('title', "like", "%" . $search . "%")
            ->orWhere('body', 'like', "%" . $search . "%");
    })
        ->with(['author', 'category'])
        ->latest('id')->paginate(5)->withQueryString();

    return view('welcome', ['posts' => $posts]);
});

Route::get('/detail/{post:slug}', function (Post $post) {
    return view('post.show', ['post' => $post]);
});

Route::get('/cat/{category:slug}', function (Category $category) {
    $posts = Post::when(request('search'), function ($q, $search) {
        $q->where(function ($q) use ($search) {
            $q->where('title', "like", "%" . $search . "%")
                ->orWhere('body', 'like', "%" . $search . "%");
        });
    })->where('category_id', $category->id)
        ->with(['author', 'category'])
        ->latest('id')->paginate(5)->withQueryString();
    return view('welcome', compact('posts'));
})->name('cat');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/post', PostController::class);

    Route::resource('/category', CategoryController::class);

    Route::resource('/photo', PhotoController::class);

    Route::resource('/user', UserController::class)->middleware('isAdmin');
});
