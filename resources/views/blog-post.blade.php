<x-home-master>

    @section('content')
        <h1 class="mt-4">{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by
            <a href="#">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on {{$post->created_at->diffForHumans()}}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{$post->post_image}}" alt="">

        <hr>

        <!-- Post Content -->
        <p>{{$post->body}}</p>

        <hr>

        @if(session()->has('comment-posted'))
            <div class="alert alert-success">
                {{session('comment-posted')}}
            </div>
        @endif

        @if(Auth::check())
            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form method="post" action="{{route('comments.store')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit comment</button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Single Comment -->
        @foreach($post->comments as $comment)
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">
                        {{$comment->author}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h5>
                    {{$comment->body}}
                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                    <div class="replies-section">
                        @foreach($comment->replies as $reply)
                            <div class="media mt-4">
                                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">
                                        {{$reply->author}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h5>
                                    {{$reply->body}}
                                </div>
                            </div>
                        @endforeach
                        <form method="post" action="{{route('replies.store')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <div class="form-group">
                                <textarea name="body" class="form-control" rows="1"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit reply</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Comment with nested comments -->
{{--        <div class="media mb-4">--}}
{{--            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">--}}
{{--            <div class="media-body">--}}
{{--                <h5 class="mt-0">Commenter Name</h5>--}}
{{--                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}

{{--                <div class="media mt-4">--}}
{{--                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">--}}
{{--                    <div class="media-body">--}}
{{--                        <h5 class="mt-0">Commenter Name</h5>--}}
{{--                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="media mt-4">--}}
{{--                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">--}}
{{--                    <div class="media-body">--}}
{{--                        <h5 class="mt-0">Commenter Name</h5>--}}
{{--                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
    @endsection

    @section('scripts')
        <script>
            $(".toggle-reply").click(function () {
                $(this).next().slideToggle("slow");
            });
        </script>
    @endsection

</x-home-master>
