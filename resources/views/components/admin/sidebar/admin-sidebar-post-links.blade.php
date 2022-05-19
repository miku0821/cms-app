<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost" aria-expanded="true" aria-controls="collapsePost">
      <i class="fas fa-fw fa-cog"></i>
      <span>Posts and Comments</span>
    </a>
    <div id="collapsePost" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        {{-- <h6 class="collapse-header">Posts</h6> --}}
        <a class="collapse-item" href="{{ route('posts.create') }}">Create a Post</a>
        <a class="collapse-item" href="{{ route('posts.index') }}">View All Posts</a>
        @if (auth()->user()->userHasRole('Admin'))
        <a class="collapse-item" href="{{route('comments.index')}}">All Comments</a>
        @endif
      </div>
    </div>
</li>