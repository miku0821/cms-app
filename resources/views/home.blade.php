@extends('layouts.home-master')
@section('content')
        @if (Auth::check())
            <h1 class="my-4" style="font-family: 'Vollkorn', serif;" >Welcome, {{auth()->user()->name}}!<br>
            </h1>
        @else
            <h1 class="my-4" style="font-family: 'Vollkorn', serif;" >Welcome to Skyblog!<br>
            </h1>
        @endif

        <!-- Blog Post -->
        @if (count($posts) > 0)
        @foreach ($posts as $post)
        <div class="row">
            <div class="col-md-10">
                <div class="card mb-5" style="box-shadow: 0 16px 8px rgb(0 0 0 / 30%);">
                    <img class="card-img-top" src="{{$post->post_image}}" alt="" style="height: 350px; margin:auto;">
                    <div class="card-body">
                    <h2 class="card-title">{{$post->title}}</h2>
                    <p class="card-text">{{Str::limit($post->content, 40)}}</p>
                    <a href="{{ route('post', ['post' => $post->id]) }}" class="btn" style="background-color: rgb(102, 174, 236); color: whitesmoke;">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                    Posted on {{$post->created_at->diffForHumans()}} by
                        <a href="{{ route('home.author', ['author' => $post->user]); }}">{{$post->user->name}}</a>
                        <div class="category float-right">
                            @foreach($post->categories as $category)
                                <span class="text-light p-2 rounded" style="background-color: rgb(14, 46, 87);">{{$category->name}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
        @endforeach
        

        <!-- Pagination -->
        {{-- <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
                <a class="page-link" href="#">&larr; Older</a>
            </li>                    
            <li class="page-item disabled">
                <a class="page-link" href="#">Newer &rarr;</a>
            </li>
        </ul> --}}
        {{$posts->links()}}
        @else
        <div class="card mb-4 text-center text-secondary border-0 bg-light">
            <div class="card-body">
               <h3>No Posts</h3> 
            </div>
        </div>
        @endif
@endsection
