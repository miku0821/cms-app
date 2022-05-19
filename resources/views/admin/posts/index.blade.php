<x-admin-master>
    @section('content')
        <h1>All Posts</h1>

        @if (session('post-deletion-status'))
            <div class="alert alert-danger">{{session('post-deletion-status')}}</div>  
        @elseif(session('post-creation-status'))
            <div class="alert alert-success">{{session('post-creation-status')}}</div>
        @elseif(session('post-update-status'))
            <div class="alert alert-warning">{{session('post-update-status')}}</div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Comments</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Comments</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->user->name}}</td>
                                <td> <a href="{{ route('post', ['post' => $post->id]) }}"> {{$post->title}}</a></td>
                                <td> <img src="data:image/png;base64,{{$post->post_image}}" alt="" width="150"> </td>
                                <td>{{$post->created_at->diffForHumans()}}</td>
                                <td>{{$post->updated_at->diffForHumans()}}</td>
                                <td><a href="{{route('comments.show', $post->id)}}">View Comments</a></td>
                                <td>
                                    @can('view', $post)
                                    <form method="get" action="{{ route('posts.edit', ['post' => $post->id])}}">
                                    @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                    </form>  
                                    @endcan
                                </td>
                                <td>
                                    @can('view', $post)
                                    <form method="post" action="{{ route('posts.destroy', ['post' => $post->id])}}">
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
            {{$posts->links()}}
        </div>



        @section('scripts')
            <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
            {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
        @endsection

    @endsection
</x-admin-master>