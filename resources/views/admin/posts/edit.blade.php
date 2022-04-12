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
                <div><img src="{{$post->post_image}}" width="300" alt=""></div>
                <label for="file">File</label>
                <input type="file" name="post_image" class="form-control-file" id="file" aria-describedby="">
            </div>
            <label for="content">Content</label><br>
            <textarea name="content" class="form-control"  id="content" cols="30" rows="10">{{$post->content}}</textarea><br>
            <button type="submit" class="btn btn-primary mt-3">Edit</button>
        </form>
    @endsection
</x-admin-master>