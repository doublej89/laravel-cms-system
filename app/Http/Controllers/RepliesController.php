<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $data = [
            'comment_id' => $request->comment_id,
            'author' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'body' => $request->body
        ];
        Reply::create($data);
        $request->session()->flash('reply-posted', 'Your message has been submitted and awaiting moderation');
        return back();
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.replies.show', ['comment' => $comment]);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();
        session()->flash('comment-deleted-message', 'The comment has been deleted');
        return back();
    }
}
