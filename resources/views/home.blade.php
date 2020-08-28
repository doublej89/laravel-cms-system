<x-home-master>

@section('content')
        <h1 class="my-4">Page Heading
            <small>Secondary Text</small>
        </h1>

        @foreach($posts as $post)
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
        <!-- Pagination -->
{{--        <ul class="pagination justify-content-center mb-4">--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="#">&larr; Older</a>--}}
{{--            </li>--}}
{{--            <li class="page-item disabled">--}}
{{--                <a class="page-link" href="#">Newer &rarr;</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
                <div class="d-flex">
                    <div class="mx-auto">
                        {{$posts->links()}}
                    </div>
                </div>

@endsection
    @section('categories-section')
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{route('category.show', $category->id)}}">{{$category->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-home-master>
