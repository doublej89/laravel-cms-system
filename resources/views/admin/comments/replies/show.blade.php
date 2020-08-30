<x-admin-master>
    @section('content')
        <h1>Comments</h1>
        @if(session('comment-deleted-message'))
            <div class="alert alert-danger">
                {{session('comment-deleted-message')}}
            </div>
            {{--        @elseif(session('post-created-message'))--}}
            {{--            <div class="alert alert-success">--}}
            {{--                {{session('post-created-message')}}--}}
            {{--            </div>--}}
        @elseif(session('comment-updated-message'))
            <div class="alert alert-success">
                {{session('comment-updated-message')}}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All replies for comment number: {{$comment->id}}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Author email</th>
                            <th>Body</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Author email</th>
                            <th>Body</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($comment->replies as $reply)
                            <tr>
                                <td>{{$reply->id}}</td>
                                <td>{{$reply->author}}</td>
                                <td>{{$reply->email}}</td>
                                <td>{{$reply->body}}</td>
                                <td>
                                    @if($reply->is_active == 1)
                                        <form method="post" action="{{route('replies.update', $reply->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="is_active" value="0">
                                            <button type="submit" class="btn btn-dark">Disapprove</button>
                                        </form>
                                    @else
                                        <form method="post" action="{{route('replies.update', $reply->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="is_active" value="1">
                                            <button type="submit" class="btn btn-info">Approve</button>
                                        </form>
                                    @endif
                                </td>
{{--                                <td>--}}
{{--                                    @if($reply->user->id == auth()->user()->id)--}}
{{--                                    <form method="post" action="{{route('replies.destroy', $reply->id)}}" enctype="multipart/form-data">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                                    </form>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
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
