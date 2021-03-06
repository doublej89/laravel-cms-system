<x-admin-master>
    @section('content')
        <h1>Users</h1>
        @if(session('user-deleted'))
            <div class="alert alert-danger">
                {{session('user-deleted')}}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Job Title</th>
                            <th>Registered At</th>
                            <th>Profile Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Job Title</th>
                            <th>Registered At</th>
                            <th>Profile Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                    @if(auth()->user()->id == $user->id)
                                        <a href="{{route('user.profile.show', $user)}}">{{$user->username}}</a>
                                    @else
                                        {{$user->username}}
                                    @endif
                                </td>
                                <td>
                                    <img height="40px" src="{{$user->avatar}}" alt="">
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->job_title}}</td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td>{{$user->updated_at->diffForHumans()}}</td>
                                <td>
                                    @if(auth()->user()->id == $user->id)
                                        <form method="post" action="{{route('user.destroy', $user->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>
