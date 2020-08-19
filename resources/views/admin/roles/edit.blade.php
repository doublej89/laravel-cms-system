<x-admin-master>
    @section('content')
        @if(session()->has('role-updated'))
            <div class="alert alert-success">
                {{session('role-updated')}}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                Edit Role: {{$role->name}}
                <form method="post" action="{{route('role.update', $role->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Role</label>
                        <input type="text" name="name" value="{{$role->name}}" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-block">Update Role</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if($permissions->isNotEmpty())
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Permission</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Permission</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td><input
                                                type="checkbox"
                                                @foreach($role->permissions as $role_permission)
                                                    @if($role_permission->slug == $permission->slug)
                                                    checked
                                                    @endif
                                                @endforeach
                                            ></td>
                                        <td>{{$permission->id}}</td>
                                        <td><a href="{{route('role.edit', $role->id)}}">{{$permission->name}}</a></td>
                                        <td>{{$permission->slug}}</td>
                                        <td>
                                            <form method="post" action="{{route('role.permission.attach', $role)}}">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="permission" value="{{$permission->id}}">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                    @if($role->permissions->contains($permission))
                                                    disabled
                                                    @endif
                                                >
                                                    Attach
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('role.permission.detach', $role)}}">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="permission" value="{{$permission->id}}">
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
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
