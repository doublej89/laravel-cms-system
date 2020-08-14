<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post) {

        return view('blog-post', ['post' => $post]);
    }

    public function create() {

        return view('admin.posts.create');
    }

    public function store() {
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'body' => 'required',
            'post_image' => 'file'
        ]);
        if (request('post_image')) {
            $inputs['post_image'] = 'storage/'.request('post_image')->store('images');
        }
        auth()->user()->posts()->create($inputs);
        session()->flash('post-created-message', 'Post has been created');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post, Request $request) {
        $post->delete();
        $request->session()->flash('post-deleted-message', 'Post has been deleted');
        return back();
    }
}
