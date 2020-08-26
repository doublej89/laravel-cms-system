<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index() {
        $posts = Post::all()->count();
        $categories = Category::all()->count();
        $comments = Comment::all()->count();
        return view('admin.index', [
            'posts' => $posts,
            'categories' => $categories,
            'comments' => $comments
        ]);
    }
}
