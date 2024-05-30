<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $post;
    private $user;

    public function __construct(Post $post,User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_posts = $this->filteredPosts();
        $suggested_users = $this->suggestedUsers();
        return view('users.home')
                ->with('all_posts', $all_posts)
                ->with('suggested_users', $suggested_users)
                ->with('post', $this->post);;
    }
    public function filteredPosts(){
        $all_posts = $this->post->latest()->get();
        $filtered_posts = [];

        foreach($all_posts as $post){
            if($post->user->isFollowed() OR $post->user->id == Auth::id()){
                $filtered_posts[] = $post;
            }
        }

        return $filtered_posts;
    }
    public function suggestedUsers(){
        $all_users = $this->user->all()->except(Auth::id());
        $suggested_users = [];
        foreach($all_users as $user){
            if(!$user->isFollowed()){
                $suggested_users[] = $user;
            }
        }
        return $suggested_users;

    }
}
