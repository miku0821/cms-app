<x-admin-master>
    @section('content')
        <h1>Edit a Post</h1>

        <form method="post" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter title" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <div><img src="data:image/png;base64,{{$post->post_image}}" width="300" alt=""></div>
                <label for="inputFile">File</label>
                <div class="custom-file">
                  <input type="file" name="post_image" class="custom-file-input" id="file">
                  <label class="custom-file-label" for="file">Choose file</label>
                </div>
            </div>
            <label for="content">Content</label><br>
            <textarea name="content" class="form-control"  id="content" cols="30" rows="10">{{$post->content}}</textarea><br>
            <div class="form-group">
                @foreach ($categories as $category)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="categories[]" class="form-check-input" id="inlineCheckbox{{$category->id}}" value="{{$category->id}}">
                    <label class="form-check-label" for="inlineCheckbox{{$category->id}}">{{$category->name}}</label>
                </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-3">Edit</button>
        </form>
    @endsection
</x-admin-master>