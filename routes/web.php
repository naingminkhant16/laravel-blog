<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPanelController;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserPanelController::class, 'index']);

Route::get('/detail/{post:slug}', [UserPanelController::class, 'detail']);

Route::get('/cat/{category:slug}', [UserPanelController::class, 'cat'])->name('cat');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/post', PostController::class);

    Route::resource('/category', CategoryController::class);

    Route::resource('/photo', PhotoController::class);

    Route::resource('/user', UserController::class)->middleware('isAdmin');
});
