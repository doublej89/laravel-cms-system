<x-admin-master>
    @section('content')
        <div class="row">
            @if(session()->has('category-deleted'))
                <div class="alert alert-danger">
                    {{session('category-deleted')}}
                </div>
            @elseif(session()->has('category-created'))
                <div class="alert alert-success">
                    {{session('category-created')}}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-3">
                <form method="post" action="{{route('categories.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Category</label>
                        <input
                            name="name"
                            id="name"
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                        >
                        <div>
                            @error('name')
                            <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Create Category</button>
                </form>
            </div>
            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Posts</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                    <th>Posts</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>
                                        <td><a href="{{route('categories.show', $category->id)}}">Show posts</a></td>
                                        <td>
                                            <form method="post" action="{{route('categories.destroy', $category->id)}}">
                                                @csrf
                                                @method('DELETE')
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
    @section('scripts')
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>
