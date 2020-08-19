<x-admin-master>
    @section('content')
        @if(session()->has('permission-updated'))
            <div class="alert alert-success">
                {{session('permission-updated')}}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                Edit Role: {{$permission->name}}
                <form method="post" action="{{route('permission.update', $permission->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Permission</label>
                        <input type="text" name="name" value="{{$permission->name}}" class="form-control">
                    </div>
                    <button class="btn btn-primary btn-block">Update Permission</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
