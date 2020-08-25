<x-home-master>
    @section('content')
        @if(count($users) > 0 || count($posts) > 0)
            @if(count($users) > 0)
                <div class="list-group">
                    <h1>Users:</h1>
                    @foreach($users as $user)
                        <a href="#" class="list-group-item list-group-item-action active">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$user->name}}</h5>
                            </div>
                            <p class="mb-1">@ {{$user->username}}</p>
                            @if($user->job_title)
                                <small>{{$user->job_title}}</small>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
            @if(count($posts) > 0)
                <div class="list-group">
                    <h1>Posts:</h1>
                    @foreach($posts as $post)
                        <a href="#" class="list-group-item list-group-item-action active">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{$post->title}}</h5>
                            </div>
                            <p class="mb-1">{{$post->body}}</p>
                            <small>{{$post->created_at}}</small>
                        </a>
                    @endforeach
                </div>
            @endif
        @else
            <h1>Nothing found</h1>
        @endif
    @endsection
</x-home-master>
