@extends('layouts.home-master')
@section('content')
    <!-- Title -->
    <h1 class="mt-4">{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
      by
      <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p>Posted on {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="{{$post->post_image ? $post->post_image : null}}" alt="">
    @if($post->post_image)
    <hr>
    @endif

    <!-- Post Content -->
    <p class="lead">{{$post->content}}</p>

    <blockquote class="blockquote">
      <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer class="blockquote-footer">Someone famous in
        <cite title="Source Title">Source Title</cite>
      </footer>
    </blockquote>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p>
    
    <hr class="mt-3">

      @if (session('comment_creation_status'))
        <div id="comment_session" style="padding-top: 70px;">
          <div class="alert alert-primary">{{session('comment_creation_status')}}</div>
        </div>
      @elseif(session('reply_creation_status'))
        <div id="comment_session" style="padding-top: 70px;">
          <div class="alert alert-success">{{session('reply_creation_status')}}</div>
        </div>
      @endif

      <!-- Comments Form -->
      <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
          <form method="post" action="{{route('comments.store')}}">
          @csrf
          <div class="form-group">
          <textarea class="form-control @error('comment') is-invalid @enderror" name="comment" rows="3"></textarea>
          @error('comment')
              <div class="invalid-feedback">{{$message}}</div>
          @enderror
          </div>
          <input type="hidden" name="post" value="{{$post->id}}">
          <button type="submit" class="btn btn-primary">Submit</button>
          </form>  
        </div>
      </div>

      <!-- Comment -->
      @if (count($comments) > 0)
      @foreach ($comments as $comment)
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="{{$comment->image}}" width="50" height="50" alt="">
          <div class="media-body">
            <h5 class="mt-0">{{$comment->user->name}}
              <small>{{date('F j, Y, \a\t  g:i A', strtotime($comment->created_at))}}</small>
            </h5>
            <p>{{$comment->comment}}</p>

            <div class="toggle-reply-container">

              <button class="reply-btn btn-sm btn-primary float-right">Reply</button>
        
              <div class="comment-reply col-md-10" style="display: none;">
                {{-- reply form --}}
                    <form method="post" action="{{route('replies.store')}}">
                    @csrf
                    <div class="form-group">
                    <textarea class="form-control @error('comment') is-invalid @enderror" name="reply" rows="2"></textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                    <input type="hidden" name="comment" value="{{$comment->id}}">
                    <input type="hidden" name="receiver" value="{{$comment->user->name}}">
                    <button type="submit" class="btn-sm btn-primary">Post a Reply</button>
                    </form>  
                {{-- end of form --}}

              </div>
          </div>
            
            {{-- nested comment --}}
            @if (count($replies = $comment->replies) > 0)
              @foreach ($replies as $reply)
                @if ($reply->is_active === 1)
                  
                
                <div class="nested-comment media mt-4" style="border-left: 2px solid rgb(163, 170, 184); padding-left: 10px;">
                  <img class="d-flex mr-3 rounded-circle" src="{{$reply->image}}" width="50" height="50" alt="">
                  <div class="media-body">
                    <h5 class="mt-0">{{$reply->user->name}}
                      <small>{{date('F j, Y, \a\t  g:i A', strtotime($comment->created_at))}}</small>
                    </h5>
                    <p>{{$reply->reply}}</p>
                  </div>
                </div>
                {{-- end of nested comment --}}
                @endif
              @endforeach
            @endif

          </div>
        </div>   
      @endforeach
      @endif

@endsection

@section('scripts')
<script>
  $(".reply-btn").click(function(){
    $(this).next().slideToggle("slow");
  });
</script>
@endsection