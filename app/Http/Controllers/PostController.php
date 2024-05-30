<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $all_categories = Category::all();

        return view('users.posts.create')
            ->with('all_categories', $all_categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //this saves posts and generates the primary key
        $this->post->user_id = Auth::id();
        $this->post->description = $request->description;
        $this->post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->save();


        // re writes your index array into associative array
        // $category_posts = [];
        foreach($request->category as $category_id){
            $category_post[] = ["category_id" => $category_id];
        }

        $this->post->categoryPost()->createMany($category_post);

        return redirect()->route('index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $post = $this->post->findOrFail($id);

        return view('users.posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);
        $all_categories = Category::all();

        $selected_categories = [];
        foreach($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category->id;
        }

        // return view('users.posts.edit')
        //             ->with(['post' => $post, 'all_categories' => $all_categories, 'selected_categories' => $selected_categories]);

        return view('users.posts.edit')
        ->with('post', $post)
        ->with('all_categories', $all_categories)
        ->with('selected_categories', $selected_categories);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post               =    $this->post->findOrFail($id);
        $post->description  =    $request->description;

        if($request->image){
            $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        }

        $post->save();

        // $category_posts = [];
        foreach($request->category as $category_id){
            $category_post[] = ["category_id" => $category_id];
            }

            $post->categoryPost()->delete();
            $post->categoryPost()->createMany($category_post);

        return redirect()->route('post.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->post->findOrFail($id)->delete();

        return redirect()->back();
    }
}
