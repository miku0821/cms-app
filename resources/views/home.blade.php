@extends('layouts.home-master')
@section('content')
        <h1 class="my-4" style="font-family: 'Vollkorn', serif;" >SkyBlog<br>
            @if (Auth::check())
                <small>Welcome, {{auth()->user()->name}}!!</small>
            @endif
        </h1>

        <!-- Blog Post -->
        @if (count($posts) > 0)
        @foreach ($posts as $post)
                <div class="card mb-4">
                    <img class="card-img-top" src="@if ($post->post_image == NULL) https://img.freepik.com/free-photo/abstract-luxury-plain-blur-grey-black-gradient-used-as-background-studio-wall-display-your-products_1258-63641.jpg?w=2000 @else data:image/png;base64,{{$post->post_image}} @endif{{$post->post_image ? $post->post_image : null}}" alt="">
                    <div class="card-body">
                    <h2 class="card-title">{{$post->title}}</h2>
                    <p class="card-text">{{Str::limit($post->content, 40)}}</p>
                    <a href="{{ route('post', ['post' => $post->id]) }}" class="btn btn-primary">Read More &rarr;</a>
                    </div>
                    <div class="card-footer text-muted">
                    Posted on {{$post->created_at->diffForHumans()}} by
                        <a href="{{ route('home.author', ['author' => $post->user]); }}">{{$post->user->name}}</a>
                        <div class="category float-right">
                            @foreach($post->categories as $category)
                                <span class="bg-info text-light p-2 rounded">{{$category->name}}</span>
                            @endforeach
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
        <div class="card mb-4 text-center border-0 bg-light">
            <div class="card-body">
               <h3>No Posts</h3> 
            </div>
        </div>
        @endif
@endsection
