<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CategoryPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category_posts'; //connect category to table
    protected $fillable = ['category_id', 'post_id']; //accsept data from an array
    public $timestamps = false;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
