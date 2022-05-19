<x-admin-master>
    @section('content')
        <h1>Users</h1>
        @if ($no_user)
            <div class="alert alert-warning">There is no users</div>
        @else

            @if (session('user-deleted'))
                <div class="alert alert-danger">{{session('user-deleted')}}</div> 
            @endif
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Avatar</th>
                      <th>Email</th>
                      <th>Created at</th>
                      <th>Updated at</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Avatar</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($users as $user)
                    <tr>
                      <td>{{$user->id}}</td>
                      <td><a href="{{route('user.profile.show', ['user' => $user])}}">{{$user->username}}</a></td>
                      <td>{{$user->name}}</td>
                      <td><img src="data:image/png;base64,{{$user->avatar}}" alt="" width=60 height=60></td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->created_at->diffForHumans()}}</td>
                      <td>{{$user->updated_at->diffForHumans()}}</td>
                      <td>
                          <form method="post" action="{{ route('user.profile.destroy', ['user' => $user]) }}" enctype="multipart/form-data">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                          </form>
                      </td>
                    </tr> 
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="link">{{$users->onEachSide(2)->links()}}</div>
          </div>
        @endif
    @endsection
    @section('scripts')
        <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
            {{-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> --}}
    @endsection
</x-admin-master>