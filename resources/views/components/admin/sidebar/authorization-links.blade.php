<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAutorization" aria-expanded="true" aria-controls="collapseAuthorization">
      <i class="fas fa-fw fa-cog"></i>
      <span>Authorization</span>
    </a>
    <div id="collapseAutorization" class="collapse" aria-labelledby="headingAuthorization" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        {{-- <h6 class="collapse-header">Posts</h6> --}}
        <a class="collapse-item" href="{{route('roles.index')}}">Roles</a>
        <a class="collapse-item" href="{{route('permissions.index')}}">Permissions</a>
      </div>
    </div>
</li>