<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-sm-10">
                <h1>Edit a Post</h1>
                <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            placeholder="Enter your title"
                            id="title"
                            value="{{$post->title}}"
                        >
                    </div>
                    <div class="form-group">
                        <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
                        <label for="file">File</label>
                        <input
                            type="file"
                            name="post_image"
                            class="form-control-file"
                            id="post_image">
                    </div>
                    <div class="form-group">
                        <textarea name="body" class="form-control" id="body" cols="30" rows="10">value={{$post->body}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            <input
                                                type="checkbox"
                                                @foreach($post->categories as $post_category)
                                                    @if($post_category->name == $category->name)
                                                        checked
                                                    @endif
                                                @endforeach
                                            >
                                        </td>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            <form method="post" action="{{route('post.category.attach', $post)}}">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="category" value="{{$category->id}}">
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                    @if($post->categories->contains($category))
                                                    disabled
                                                    @endif
                                                >
                                                    Attach
                                                </button>
                                            </form>

                                        </td>
                                        <td>
                                            <form method="post" action="{{route('post.category.detach', $post)}}">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="category" value="{{$category->id}}">
                                                <button type="submit"
                                                        class="btn btn-primary"
                                                        @if(!$post->categories->contains($category))
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
