<x-admin-master>
    @section('content')
        <h1>Permission Edit: {{$permission->name}}</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="{{route('permissions.update', ['permission' => $permission])}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                <label for="permission"></label>
                <input type="text" name="permission_name" class="form-control"value="{{$permission->name}}">
                </div>
                <input type="hidden" name="id" value="{{$permission->id}}">
                <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>