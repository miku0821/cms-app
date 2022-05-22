<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::paginate(5);
        $categories = Category::all();

        return view('home', ['posts' => $posts, 'categories' => $categories]);
    }

    public function findByAuthor($author)
    {
        $posts = Post::where('user_id', $author)
            ->paginate(5);
        $categories = Category::all();
        $author = User::find($author)->username;

        return view('searched-by', ['posts' => $posts, 'categories' => $categories, 'author' => $author]);
    }
}
