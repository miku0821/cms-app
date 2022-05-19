<x-admin-master>
    @section('content')
        <h1>Category Edit: {{$category->name}}</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="post" action="{{route('categories.update', ['category' => $category])}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                <label for="category"></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">
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