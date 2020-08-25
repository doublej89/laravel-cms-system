<x-admin-master>
    @section('content')
        @if(count($posts) > 0 || count($roles) > 0 || count($categories) > 0 || count($users) > 0)
            @if(count($posts) > 0)
                <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Post results for search term: {{$query}}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Owner</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Comments</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
    {{--                        <tfoot>--}}
    {{--                        <tr>--}}
    {{--                            <th>Id</th>--}}
    {{--                            <th>Owner</th>--}}
    {{--                            <th>Title</th>--}}
    {{--                            <th>Image</th>--}}
    {{--                            <th>Comments</th>--}}
    {{--                            <th>Created At</th>--}}
    {{--                            <th>Updated At</th>--}}
    {{--                            <th>Delete</th>--}}
    {{--                        </tr>--}}
    {{--                        </tfoot>--}}
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>
                                        <a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a>
                                    </td>
                                    <td>
                                        <img height="40px" src="{{$post->post_image}}" alt="">
                                    </td>
                                    <td><a href="{{route('comments.show', $post->id)}}">View comments</a></td>
                                    <td>{{$post->created_at->diffForHumans()}}</td>
                                    <td>{{$post->updated_at->diffForHumans()}}</td>
                                    <td>
                                        @can('view', $post)
                                            <form method="post" action="{{route('post.destroy', $post->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            @if(count($roles) > 0)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Role results for search term: {{$query}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Role</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
        {{--                        <tfoot>--}}
        {{--                        <tr>--}}
        {{--                            <th>Id</th>--}}
        {{--                            <th>Role</th>--}}
        {{--                            <th>Slug</th>--}}
        {{--                            <th>Delete</th>--}}
        {{--                        </tr>--}}
        {{--                        </tfoot>--}}
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td><a href="{{route('role.edit', $role->id)}}">{{$role->name}}</a></td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <form method="post" action="{{route('role.destroy', $role->id)}}">
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
            @endif
            @if(count($categories) > 0)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Category results for search term: {{$query}}</h6>
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
        {{--                        <tfoot>--}}
        {{--                        <tr>--}}
        {{--                            <th>Id</th>--}}
        {{--                            <th>Category</th>--}}
        {{--                            <th>Posts</th>--}}
        {{--                            <th>Delete</th>--}}
        {{--                        </tr>--}}
        {{--                        </tfoot>--}}
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
            @endif
            @if(count($users) > 0)
                <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User results for search term: {{$query}}</h6>
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
    {{--                        <tfoot>--}}
    {{--                        <tr>--}}
    {{--                            <th>Id</th>--}}
    {{--                            <th>Username</th>--}}
    {{--                            <th>Avatar</th>--}}
    {{--                            <th>Name</th>--}}
    {{--                            <th>Job Title</th>--}}
    {{--                            <th>Registered At</th>--}}
    {{--                            <th>Profile Updated At</th>--}}
    {{--                            <th>Delete</th>--}}
    {{--                        </tr>--}}
    {{--                        </tfoot>--}}
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td><a href="{{route('user.profile.show', $user)}}">{{$user->username}}</a></td>
                                    <td>
                                        <img height="40px" src="{{$user->avatar}}" alt="">
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->job_title}}</td>
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                    <td>{{$user->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <form method="post" action="{{route('user.destroy', $user->id)}}">
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
            @endif
        @else
            <h1>Nothing found for search term: {{$query}}</h1>
        @endif
    @endsection
</x-admin-master>
