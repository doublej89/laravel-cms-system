<x-home-master>
    @section('content')
        @if(count($users) > 0 || count($posts) > 0)
            @if(count($users) > 0)
                <div class="list-group mb-4">
                    <p class="h3 mb-4">All Posts with the search term: {{$query}}</p>
                    @foreach($users as $user)
                        <a href="{{route('user.profile', $user->id)}}" class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{$user->avatar ? $user->avatar : "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$user->name}}</h5>
                                        <p class="card-text">@ {{$user->username}}</p>
                                        <p class="card-text"><small class="text-muted">{{$user->job_title}}</small></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
            @if(count($posts) > 0)
                <div class="list-group">
                    <p class="h3 mb-4">All Posts with the search term: {{$query}}</p>
                    @foreach($posts as $post)
                        <a href="{{route('post.show', $post->id)}}" class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="{{$post->post_image}}" class="card-img" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$post->title}}</h5>
                                        <p class="card-text">{{$post->body}}</p>
                                        <p class="card-text"><small class="text-muted">{{$post->created_at->diffForHumans()}}</small></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        @else
            <h1>Nothing found</h1>
        @endif
    @endsection
</x-home-master>
