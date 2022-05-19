<x-admin-master>
    @section('content')
        <h1>Permission Edit: {{$permission->name}}</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="{{route('permissions.update', ['permission' => $permission])}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="permission">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$permission->name}}">
                    <input type="hidden" name="id" value="{{$permission->id}}">
                    <input type="hidden" name="slug" value="{{$permission->slug}}">
                    @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>