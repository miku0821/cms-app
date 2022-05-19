<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    public function index(){
        $posts = Auth::user()->posts()->paginate(5);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post){
        $comments = $post->comments()->whereIsActive(1)->get();
        $categories = Category::all();
        
        return view('blog-post', ['post' => $post, 'comments' => $comments, 'categories' => $categories]);
    }

    public function create(){
        $categories = Category::all();
        return view('admin.posts.create', ['categories' => $categories]);
    }


    public function store(Request $request){

        // validation
        $validated = $request->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'content' => 'required'
        ]);

        // store an uploaded file to move an uploaded file to one of your disks
        if($request->hasFile('post_image')){
            $image = base64_encode(file_get_contents($request->post_image->getRealPath()));
        }else{
            $image = NULL;
        }

        // save a relational model instance
        $post = Auth::user()->posts()->create([
            'title' => $request->title,
            'post_image' => $image,
            'content' => $request->content,
        ]);


        if($categories = $request->categories){
            foreach($categories as $category){
                $post->categories()->attach($category);
            }
        }


        $request->session()->flash('post-creation-status', 'The post was successfully created');
        return redirect()->route('posts.index');
    }


    public function edit(Post $post){
        $this->authorize('view', $post);
        $categories = Category::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories]);
    }


    public function update(Post $post, Request $request){
        $this->authorize('update', $post);
        $validated = $request->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'content' => 'required'
        ]);
        
        if($request->hasFile('post_image')){
            $image = base64_encode(file_get_contents($request->post_image->getRealPath()));
        }else{
            $image = NULL;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->post_image = $image;


        $post->save();

        if($categories = $request->categories){
            foreach($categories as $category){
                $post->categories()->attach($category);
            }
        }


        $request->session()->flash('post-update-status', 'The post waws successfully updated');
        return redirect()->route('posts.index');
    }


    public function destroy(Post $post, Request $request){
        $this->authorize('delete', $post);

        $post->delete();
        $request->session()->flash('post-deletion-status', 'The post was successfully deleted');
        return back();
    }

    public function searchByContent(Request $request)
    {
        $validated = $request->validate([
            'searched_txt' => 'required',
        ]);

        $searched_txt = $request->searched_txt;

        $posts = Post::where('title', 'like', "%".$searched_txt."%")
        ->orWhere('content', 'like', "%".$searched_txt."%")
        ->paginate(5);

        $categories = Category::all();

        return view('home', ['posts' => $posts, 'categories' => $categories]);
    }


    public function searchByAuthor(Request $request){
        $validated = $request->validate([
            'searched_txt' => 'required',
        ]);

        $author = $request->searched_txt;

        $user_ids = User::where('name', 'like', "%".$author."%")->get('id');

        if(count($user_ids) >= 1){
                $posts = Post::whereIn('user_id', $user_ids)
                        ->paginate(5);
        }else{
            $posts = Post::where('user_id', $user_ids)
            ->paginate(5);
        }
      
        $categories = Category::all();

        return view('home', ['posts' => $posts, 'categories' => $categories]);
    }
}