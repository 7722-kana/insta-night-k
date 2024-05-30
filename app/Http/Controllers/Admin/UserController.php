<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\CategoryPost;


class UserController extends Controller
{
    protected $user;
    protected $post;
    protected $category_post;


    public function __construct(User $user, Post $post, CategoryPost $category_post)
    {
        $this->user = $user;
        $this->post = $post;
        $this->category_post = $category_post;
    }

    public function indexUsers(){
        $all_users = $this->user->withTrashed()->latest()->get();
        return view('admin.users.index')->with('all_users', $all_users);
    }

    public function indexPosts()
    {
        $all_posts = $this->post->with('categories', 'user')->withTrashed()->latest()->get();
        return view('admin.posts.index')->with('all_posts', $all_posts);
    }



    public function activate($user_id){
        $user = $this->user->withTrashed()->findOrFail($user_id);
        $user->restore();
        return redirect()->back();
    }

    public function deactivate($user_id){
        $user = $this->user->findOrFail($user_id);
        $user->delete();
        return redirect()->back();
    }

    public function unhide($post_id){
        $post = $this->post->withTrashed()->findOrFail($post_id);
        $post->restore();
        return redirect()->back();
    }

    public function hide($post_id){
        $post = $this->post->findOrFail($post_id);
        $post->delete();
        return redirect()->back();
    }



}
