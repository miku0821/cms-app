<x-admin-master>
    @section('content')
    <h1>Edit Role: {{$role->name}}</h1>
    <div class="row">
        <div class="col-md-6">
            <form method="post" action="{{route('roles.update', ['role' => $role])}}">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="role_name">Name</label>
                    <input type="text" name="role_name" class="form-control @error('role_name') is-invalid @enderror" id="role_name" value="{{$role->name}}">
                    <input type="hidden" name="id" value="{{$role->id}}">
                    @error('role_name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>            
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12">
            @if ($permissions->isNotEmpty())
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Options</th>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Attach</th>
                          <th>Detach</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Options</th>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Attach</th>
                          <th>Detach</th>
                        </tr>
                      </tfoot>
                      <tbody>
                          @foreach ($permissions as $permission)
                              <tr>
                                  <td><input type="checkbox"
                                                @foreach ($role->permissions as $role_permission)
                                                    @if ($role_permission->slug == $permission->slug)
                                                        checked
                                                    @endif
                                                @endforeach></td>
                                  <td>{{$permission->id}}</td>
                                  <td>{{$permission->name}}</td>
                                  <td>{{$permission->slug}}</td>
                                  <td>
                                    <form method="post" action="{{route('role.permission.attach', ['role' => $role])}}">
                                        @csrf
                                        @method('PUT')
                                            <input type="hidden" name="permission" value="{{$permission->id}}">
                                            <button class="btn btn-primary"
                                                @if($role->permissions->contains($permission))
                                                    disabled
                                                @endif
                                            >
                                                Attach
                                            </button>
                                    </form>
                                  </td>
                                  <td>
                                    <form method="post" action="{{route('role.permission.detach', ['role' => $role])}}">
                                        @csrf
                                        @method('PUT')
                                            <input type="hidden" name="permission" value="{{$permission->id}}">
                                            <button class="btn btn-danger"
                                                @if(!$role->permissions->contains($permission))
                                                    disabled
                                                @endif
                                            >
                                                Detach
                                            </button>
                                    </form>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endsection
</x-admin-master>