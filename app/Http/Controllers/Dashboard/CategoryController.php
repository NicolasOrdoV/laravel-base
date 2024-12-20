<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('editor.category.index')) {
            return abort(403);
        }
        $categories = Category::paginate(2);
        return view('dashboard.category.index', compact('categories'));
        //dd($post->category->title);
        // $post->update(
        //     [
        //         'title' => 'test title new',
        //         'slug' => 'test slug',
        //         'content' => 'test contrent',
        //         'category_id' => 1,
        //         'description' => 'test description',
        //         'posted' => 'not',
        //         'image' => 'test image'
        //     ]
        // );
        // $post->delete();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('editor.post.create')) {
            return abort(403);
        }
        $category = new Category();
        return view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        if(!Auth::user()->hasPermissionTo('editor.post.store')) {
            return abort(403);
        }
        $validated = Validator::make($request->all(), [
            'title' => 'required|min:5|min:500',
            'slug' => 'required|min:5|min:500'
        ]);
        // $request->validate([
        //     'title' => 'required|min:5|min:500',
        //     'slug' => 'required|min:5|min:500',
        //     'content' => 'required|min:7',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|min:7',
        //     'posted' => 'required'
        // ]);

        // Post::create($request->all()); otra forma de insertar
        Category::create(
            [
                'title' => $request->title,
                'slug' => $request->slug
            ]
        );
        return to_route('category.index')->with('status', 'Categoria creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if(!Auth::user()->hasPermissionTo('editor.post.show')) {
            return abort(403);
        }
        return view('dashboard.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if(!Auth::user()->hasPermissionTo('editor.post.update')) {
            return abort(403);
        }
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Category $category)
    {
        if(!Auth::user()->hasPermissionTo('editor.post.update')) {
            return abort(403);
        }
        $data = $request->validated();
        $category->update($data);
        return to_route('category.index')->with('status', 'Categoria actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(!Auth::user()->hasPermissionTo('editor.post.delete')) {
            return abort(403);
        }
        $category->delete();
        return to_route('category.index')->with('status', 'Category delete');
    }
}
