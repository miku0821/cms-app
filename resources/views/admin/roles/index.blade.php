<x-admin-master>
    @section('content')
    <h1>Roles</h1>
    @if (session('create_status'))
        <div class="alert alert-primary">{{session('create_status')}}</div>
    @elseif(session('update_status'))
        <div class="alert alert-warning">{{session('update_status')}}</div>
    @elseif(session('destroy_status'))
        <div class="alert alert-danger">{{session('destroy_status')}}</div>
    @endif
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('roles.store')}}">
                @csrf
                <div class="form-group">
                <label for="name">Role Name</label>
                <input type="text" name="role_name" class="form-control @error('role_name') is-invalid @enderror" id="" aria-describedby="" placeholder="">
                    @error('role_name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </form>
            </div>
            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Slug</th>
                              <th>Delete</th>
                            </tr>
                          </thead>
                          <tfoot>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Slug</th>
                              <th>Delete</th>
                            </tr>
                          </tfoot>
                          <tbody>
                              @foreach ($roles as $role)
                                  <tr>
                                      <td>{{$role->id}}</td>
                                      <td>@if ($role->name === 'Admin')
                                            <div>{{$role->name}}</div>
                                          @else
                                            <a href="{{route('roles.edit', ['role' => $role])}}">{{$role->name}}</a>
                                           @endif
                                        </td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <form method="post" action="{{route('roles.destroy', ['role' => $role])}}">
                                                @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger" 
                                        @if ($role->name === 'Admin')
                                            disabled
                                        @endif>Delete</button>
                                        </form>
                                    </td>
                                  </tr>
                              @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-admin-master>