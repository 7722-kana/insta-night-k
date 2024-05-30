<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;


class CategoryController extends Controller
{

    protected $category_post;
    protected $category;


    public function __construct(Category $category_post, Category $category)
    {
        $this->category_post = $category_post;
        $this->category = $category;
    }

    public function index()
    {
        $categories = Category::withCount('posts')->get();
        $uncategorizedCount = Post::doesntHave('categories')->count();

        return view('admin.categories.index', [
            'categories' => $categories,
            'uncategorizedCount' => $uncategorizedCount
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,NULL,id,deleted_at,NULL',
        ]);
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('admin.categories.index');
    }

    public function update(Request $request, $category_id)
    {
        $request->validate([
            'new_name' => 'required|string|unique:categories,name,' . $category_id . ',id,deleted_at,NULL',
        ]);


        $category = $this->category->findOrFail($category_id);
        $category->name = $request->input('new_name');
        $category->save();

        return redirect()->back();
    }


    public function delete($category_id)
    {
        $category = Category::withTrashed()->findOrFail($category_id);
        $uncategorizedCategory = Category::firstOrCreate(['name' => 'Uncategorized']);

        // Move posts to Uncategorized category
        $category->posts()->update(['category_id' => $uncategorizedCategory->id]);
        $uncategorizedCount = Post::doesntHave('categories')->count();

        $category->delete();

        return redirect()->back();
    }
}
