<x-admin-master>
    @section('content')
        
        @if (count($replies) > 0)
    
        <h1>Replies</h1>
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
                            <th>reply</th>
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
                             <th>Reply</th>
                             <th>Created at</th>
                             <th>Updated at</th>
                             <th>Update</th>
                             <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($replies as $reply)
                            <tr>
                                <td>{{$reply->id}}</td>
                                <td>{{$reply->user->name}}</td>
                                <td>{{$reply->email}}</td>
                                <td><a href="{{route('post', ['post' => $reply->comment->post->id])}}}">{{$reply->comment->post->title}}</a></td>
                                <td>{{Str::limit($reply->reply, 10)}}</td>
                                <td>{{$reply->created_at->diffForHumans()}}</td>
                                <td>{{$reply->updated_at->diffForHumans()}}</td>
                                <td>
                                    @can('view', $reply)
                                    @if ($reply->is_active == 1)
                                        <form method="post" action="{{route('replies.update', ['reply' => $reply])}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="0">
                                            <button type="submit" class="btn btn-success btn-sm">Un-approve</button>
                                        </form>  
                                    @else
                                        <form method="post" action="{{route('replies.update', ['reply' => $reply])}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="is_active" value="1">
                                            <button type="submit" class="btn btn-warning btn-sm">Approve</button>
                                        </form>  
                                    @endif
                                    @endcan
                                </td>
                                <td>
                                    @can('view', $reply)
                                    <form method="post" action="{{route('replies.destroy', ['reply' => $reply])}}">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>  
                                    @endcan
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
            <h1>No replies</h1>
         </div>
   
         @endif
    @endsection
</x-admin-master>