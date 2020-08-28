<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('admin.categories.index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store()
    {
        request()->validate(['name' => ['required', 'unique:categories']]);
        Category::create([
            'name' => request('name'),
        ]);
        session()->flash('category-created', 'A new category created');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        if (request()->is('admin/*')) {
            return view('admin.categories.show', ['posts' => $category->posts, 'category' => $category]);
        }
        return view('category', ['posts' => $category->posts()->paginate(5), 'category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Category $category)
    {
        $category->name = request('name');
        if ($category->isDirty('name')) {
            $category->save();
            session()->flash('category-updated', 'Category update: '.request('name'));
        } else {
            session()->flash('category-updated', 'Nothing has been updated');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('category-deleted', 'The category '.$category->name.' has been deleted');
        return back();
    }
}
