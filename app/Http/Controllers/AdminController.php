<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class AdminController extends Controller
{
    public function index(){
        $postsCount = Post::count();
        $commentsCount = Comment::count();
        $usersCount = User::count();
        return view('admin.index', compact('postsCount', 'commentsCount', 'usersCount'));
    }


}
