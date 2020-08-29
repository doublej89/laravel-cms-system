<x-home-master>

    @section('content')
        <h1 class="mt-4">{{$post->title}}</h1>

        <!-- Author -->
        <p class="lead">
            by
            <a href="{{route('user.profile', $post->user->id)}}">{{$post->user->name}}</a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on <a href="{{route('post.show', $post->id)}}">{{$post->created_at->diffForHumans()}}</a></p>

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
                <img height="50px" class="d-flex mr-3 rounded-circle" src="{{$comment->avatar ? $comment->avatar : "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"}}" alt="">
                <div class="media-body">
                    <h5 class="mt-0">
                        <a href="{{route('user.profile', $comment->post->user->id)}}">{{$comment->author}}</a>
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h5>
                    {{$comment->body}}
{{--                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>--}}
                    <div class="replies-section">
                        @foreach($comment->replies as $reply)
                            <div class="media mt-4">
                                <img height="50px" class="d-flex mr-3 rounded-circle" src="{{$reply->avatar ? $reply->avatar : "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"}}" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">
                                        {{$reply->author}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h5>
                                    {{$reply->body}}
                                </div>
                            </div>
                        @endforeach
                        <form method="post" action="{{route('replies.store')}}" class="mt-3" enctype="multipart/form-data">
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

    @section('categories-section')
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <ul class="list-unstyled mb-0 d-flex flex-row justify-content-around flex-wrap">
                        @foreach($post->categories as $category)
                            <li class="mx-3">
                                <a href="{{route('category.show', $category->id)}}">{{$category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            $(".toggle-reply").click(function () {
                $(this).next().slideToggle("slow");
            });
        </script>
    @endsection

</x-home-master>
