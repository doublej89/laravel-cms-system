<x-home-master>
    @section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body bg-info text-white mb-3">
                    <div class="row justify-content-center">
                        <img
                            class="rounded-circle"
                            src="{{$user->avatar ? $user->avatar : "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"}}"
                            alt=""
                        >
                    </div>
                    <div class="text-center">
                        <h1 class="display-4 text-center">
                            {{$user->name}}
                        </h1>
                        <p class="lead text-center">
                            <span>@ {{$user->username}}</span>
                        </p>
                        <p>{{$user->job_title}}</p>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="my-4">All posts by {{$user->name}}</h1>

        @foreach($user->posts as $post)
        <!-- Blog Post -->
            <div class="card mb-4">
                <img class="card-img-top" src="{{$post->post_image}}" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">{{$post->title}}</h2>
                    <p class="card-text">{{Str::limit($post->body, '100', '...')}}</p>
                    <a href="{{route('post.show', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on <a href="{{route('post.show', $post->id)}}">{{$post->created_at->diffForHumans()}}</a>
                </div>
            </div>
        @endforeach
    @endsection
</x-home-master>
