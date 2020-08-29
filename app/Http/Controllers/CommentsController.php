<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function index()
    {
        return view('admin.comments.index', ['comments' => Comment::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $data = [
            'post_id' => $request->post_id,
            'author' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'body' => $request->body
        ];
        Comment::create($data);
        $request->session()->flash('comment-posted', 'Your message has been submitted and awaiting moderation');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = $post->comments;
        return view('admin.comments.show', ['comments' => $comments, 'post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Comment $comment)
    {
        $comment->update(request()->all());
        session()->flash('comment-updated-message', 'The comment was updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        session()->flash('comment-deleted-message', 'The comment has been deleted');
        return back();
    }
}
