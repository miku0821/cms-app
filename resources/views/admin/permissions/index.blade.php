<x-admin-master>
    @section('content')
        <h1>Permissions</h1>
        @if (session('creation-status'))
            <div class="alert alert-primary">{{session('creation-status')}}</div>
        @elseif(session('edit-status'))
            <div class="alert alert-warning">{{session('edit-status')}}</div>
        @elseif(session('destroy-status'))
            <div class="alert alert-danger">{{session('destroy-status')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('permissions.store')}}">
                @csrf
                <div class="form-group">
                <label for="name">Permission Name</label>
                <input type="text" name="permission_name" class="form-control @error('permission_name') is-invalid @enderror" id="" aria-describedby="" placeholder="">
                    @error('permission_name')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mb-3">Submit</button>
                </form>
            </div>
            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>
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
                              @foreach ($permissions as $permission)
                                  <tr>
                                      <td>{{$permission->id}}</td>
                                      <td><a href="{{route('permissions.edit', ['permission' => $permission])}}">{{$permission->name}}</a></td>
                                      <td>{{$permission->slug}}</td>
                                      <td>
                                          <form method="post" action="{{route('permissions.destroy', ['permission' => $permission])}}">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-danger">Delete</button>
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