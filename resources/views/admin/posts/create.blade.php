<x-admin-master>
    @section('content')
        <h1>Create</h1>

        <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter title">
                @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputFile">File</label>
                <div class="custom-file">
                    <input type="file" name="post_image" class="custom-file-input" id="file">
                    <label class="custom-file-label" for="file">Choose file</label>
                  </div>
                @error('post_image')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <label for="content">Content</label><br>
            <textarea name="content" class="form-control"  id="content" cols="30" rows="10" placeholder="Write whatever you like"></textarea><br>

            <div class="form-group">
                @foreach ($categories as $category)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="categories[]" class="form-check-input" id="inlineCheckbox{{$category->id}}" value="{{$category->id}}">
                    <label class="form-check-label" for="inlineCheckbox{{$category->id}}">{{$category->name}}</label>
                </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    @endsection
</x-admin-master>

