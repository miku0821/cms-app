<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="true" aria-controls="collapsePost">
      <i class="fas fa-fw fa-cog"></i>
      <span>Categories</span>
    </a>
    <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('categories.create') }}">Create Category</a>
        <a class="collapse-item" href="{{route('categories.index')}}">All Categories</a>
      </div>
    </div>
</li>