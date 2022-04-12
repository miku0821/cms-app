<x-admin-master>
    @section('content')
        
        @if (count($comments) > 0)
    
        <h1>Comments</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>user</th>
                            <th>Email</th>
                            <th>Post</th>
                            <th>Comment</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Update</th>
                            <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                             <th>Id</th>
                             <th>user</th>
                             <th>Email</th>
                             <th>Post</th>
                             <th>Comment</th>
                             <th>Created at</th>
                             <th>Updated at</th>
                             <th>Update</th>
                             <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($comments as $comment)
                            <tr>
                                <td>{{$comment->id}}</td>
                                <td>{{$comment->user->name}}</td>
                                <td>{{$comment->email}}</td>
                                <td><a href="{{route('post', ['post' => $comment->post])}}}">{{$comment->post->title}}</a></td>
                                <td>{{$comment->comment}}</td>
                                <td>{{$comment->created_at->diffForHumans()}}</td>
                                <td>{{$comment->updated_at->diffForHumans()}}</td>
                                <td>
                                    @can('view', $comment)
                                    @if ($comment->is_active == 1)
                                        <form method="post" action="{{route('comments.update', ['comment' => $comment])}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="0">
                                            <button type="submit" class="btn btn-success btn-sm">Un-approve</button>
                                        </form>  
                                    @else
                                        <form method="post" action="{{route('comments.update', ['comment' => $comment])}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="1">
                                            <button type="submit" class="btn btn-warning btn-sm">Approve</button>
                                        </form>  
                                    @endif
                                    @endcan
                                </td>
                                <td>
                                    <form method="post" action="{{route('comments.destroy', ['comment' => $comment])}}">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>  
                                </td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- {{$posts->links()}} --}}
        </div>

        @else
         <div class="row d-flex align-items-center justify-content-center" style="height: 700px">
            <h1>No Comments</h1>
         </div>
   
         @endif
    @endsection
</x-admin-master>