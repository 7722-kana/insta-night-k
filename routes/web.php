<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;




Auth::routes();
Route::get('/followers', [HomeController::class, 'showFollowers'])->name('followers.show');

Route::group(["middleware" => "auth"], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/store/post',[PostController::class,'store'])->name('post.store');
    Route::get('/show/post/{id}',[PostController::class,'show'])->name('post.show');
    Route::get('/edit/post/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('update/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/destroy/post/{id}',[PostController::class,'destroy'])->name('post.destroy');


    #comment
    Route::group(["as"=>"comment.", "prefix"=>"comment"], function () {
        Route::post('/store/{id}',[CommentController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}',[CommentController::class, 'destroy'])->name('destroy');
    });

    Route::group(["as"=>"profile.", "prefix"=>"profile"], function () {
        Route::get('/show/{id}',[ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        // Route::get('/following/{id}', [FollowController::class, 'store'])->name('store');
        // Route::get('/follower/{id}', [FollowController::class, 'destroy'])->name('destroy');

    });

    Route::group(["as"=>"like.", "prefix"=>"like"], function () {
        Route::post('/store/{id}', [LikeController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [LikeController::class, 'destroy'])->name('destroy');
    });

    Route::group(["as"=>"follow.", "prefix"=>"follow"], function () {
        Route::post('/store/{id}', [FollowController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [FollowController::class, 'destroy'])->name('destroy');

    });

    Route::group(["as"=>"admin.", "prefix"=>"admin"], function () {
        Route::get('/users', [UserController::class, 'indexUsers'])->name('users.index');
        Route::patch('/users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
        Route::delete('/users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');


        Route::get('/posts', [UserController::class, 'indexPosts'])->name('posts.index');
        Route::patch('/posts/{id}/unhide', [UserController::class, 'unhide'])->name('posts.unhide');
        Route::delete('/posts/{id}/hide', [UserController::class, 'hide'])->name('posts.hide');


        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::patch('/categories/{id}/edit', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}/delete', [CategoryController::class, 'delete'])->name('categories.delete');


    });


});

