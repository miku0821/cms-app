<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'post_image', 'content'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // public function getPostImageAttribute($value){
    //     if(strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE){
    //         return $value;
    //     }elseif($value === NULL){
    //         return NULL;
    //     }
    //     return asset('storage/'.$value);
    // }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
