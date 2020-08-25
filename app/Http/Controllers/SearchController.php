<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search() {
        $query = request('query');
        if (request('query') != "") {
            $users = User::where( 'name', 'LIKE', '%' . $query . '%' )
                ->orWhere('username', 'LIKE', '%' . $query . '%')
                ->orWhere( 'email', 'LIKE', '%' . $query . '%' )
                ->get ();
            $posts = Post::where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('body', 'LIKE', '%' . $query . '%')
                ->get();
            $categories = Category::where('name', 'LIKE', '%' . $query . '%')->get();
            foreach ($categories as $category) {
                $posts = $posts->merge($category->posts);
            }
            return view('search', ['users' => $users, 'posts' => $posts, 'query' => $query]);
        }
        session()->flash('empty-search', 'Search term cannot be empty');
        return back();
    }

    public function adminSearch() {
        $query = request('query');
        if (request('query') != "") {
            $users = User::where( 'name', 'LIKE', '%' . $query . '%' )
                ->orWhere('username', 'LIKE', '%' . $query . '%')
                ->orWhere( 'email', 'LIKE', '%' . $query . '%' )
                ->get ();
            $posts = Post::where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('body', 'LIKE', '%' . $query . '%')
                ->get();
            $categories = Category::where('name', 'LIKE', '%' . $query . '%')->get();
            $roles = Role::where('name', 'LIKE', '%' . $query . '%')
                ->orWhere('slug', 'LIKE', '%' . $query . '%')
                ->get();
            return view('admin.search', [
                'users' => $users,
                'posts' => $posts,
                'categories' => $categories,
                'roles' => $roles,
                'query' => $query
            ]);
        }
        session()->flash('empty-search', 'Search term cannot be empty');
        return back();
    }


}
