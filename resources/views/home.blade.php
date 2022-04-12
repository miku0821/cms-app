@extends('layouts.home-master')
@section('content')
        <h1 class="my-4">Blog Home <br>
            @if (Auth::check())
                <small>Welcome, {{auth()->user()->name}}!!</small>
            @else
                <small>Enjoy browsing!!</small>
            @endif
        </h1>

        <!-- Blog Post -->
        @foreach ($posts as $post)
        <div class="card mb-4">
            <img class="card-img-top" src="{{$post->post_image ? $post->post_image : null}}" alt="">
            <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            <p class="card-text">{{Str::limit($post->content, 40)}}</p>
            <a href="{{ route('post', ['post' => $post->id]) }}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
            Posted on {{$post->created_at->diffForHumans()}} by
            <a href="#">{{$post->user->name}}</a>
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
@endsection
