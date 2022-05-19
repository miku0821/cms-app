<div class="col-md-4">

    <!-- Search Widget -->
    <div class="card my-4">
      <h5 class="card-header">Search</h5>
      <div class="card-body">
        <div class="by-content">
          <div>Search by the Title and Contents</div>
        <form method="post" action="{{ route('posts.search') }} ">
        @csrf
        <div class="input-group">
          <input type="text" name="searched_txt" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Go!</button>
          </span>
        </div>
        </form>
      </div>
      <div class="by-author mt-3">
        <div>Search by the Author</div>
        <form method="post" action="{{ route('posts.author.search') }} ">
          @csrf
          <div class="input-group">
            <input type="text" name="searched_txt" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="submit">Go!</button>
            </span>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
      <h5 class="card-header">Categories</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <ul class="list-unstyled mb-0">

              @foreach ($categories as $category)
              <li>
                <a href="{{ route('category.sort', ['category' => $category]) }}" style="font-size: 18px;">★{{$category->name}}</a>
              </li>
              @endforeach

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>