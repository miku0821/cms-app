<x-admin-master>
    @section('content')
        <h1>Categories</h1>
        @if (session('create_status'))
            <div class="alert alert-primary">{{session('create_status')}}</div>
        @elseif(session('update_status'))
            <div class="alert alert-warning">{{session('update_status')}}</div>
        @elseif(session('destroy_status'))
            <div class="alert alert-danger">{{session('destroy_status')}}</div>
        @endif

            <div class="row">
                <div class="col-sm-3">
                    <form method="post" action="{{route('categories.store')}}">
                    @csrf
                    <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" aria-describedby="" placeholder="">
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    </form>
                </div>

                <div class="col-sm-9 mb-4">
                    <div class="card shadow">
                        @if(count($categories) > 0)
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                            <td>{{$category->id}}</td>
                                            <td><a href="{{route('categories.edit', ['category' => $category])}}">{{$category->name}}</a></td>
                                            <td>{{$category->created_at->diffForHumans()}}</td>
                                            <td>{{$category->updated_at->diffForHumans()}}</td>
                                            <td>
                                                <form method="post" action="{{route('categories.destroy', ['category' => $category])}}">
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
                        {{-- {{$comments->links()}} --}}
                        @else
                        <div class="card-body">
                            <h3>No categories</h3>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
    @endsection
</x-admin-master>