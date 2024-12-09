<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //session()->flush();
        //session()->fotget('key');
        //session(['key'=> 'value']);
        $posts = Post::paginate(10);
        return view('dashboard.post.index', compact('posts'));
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
        $categories = Category::pluck('id', 'title');
        $post = new Post();
        return view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|min:5|min:500',
            'slug' => 'required|min:5|min:500',
            'content' => 'required|min:7',
            'category_id' => 'required|integer',
            'description' => 'required|min:7',
            'posted' => 'required'
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
        // Post::create(
        //     [
        //         'title' => $request->title,
        //         'slug' => $request->slug,
        //         'content' => $request->content,
        //         'category_id' => $request->category_id,
        //         'description' => $request->description,
        //         'posted' => $request->posted,
        //         'image' => $request->image
        //     ]
        // );

        $post = new Post($request->validated());
        auth()->user()->post()->save($post);
        return to_route('post.index')->with('status', 'Post creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Gate::check('create', $post);
        // Gate::any(['create', 'update'], $post);
        // Gate::none(['create', 'update'], $post);
        // auth()->user()->can('create', $post);
        // auth()->user()->cannot('create', $post);
        // Gate::allowIf(fn(User $user) => $user->id > 0);
        // Gate::denyIf(fn(User $user) => $user->id > 0);

        Gate::authorize('update', $post);
        // if (!Gate::inspect('update', $post)->allowed()) {
        //     return abort(403, "No entraste");
        // }
        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $filename = time() . "." . $data['image']->extension();
            $request->image->move(public_path('upload/post'), $filename);
        }
        Cache::forget('post_show_' . $post->id);
        $post->update($data);
        return to_route('post.index')->with('status', 'Post actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('post.index')->with('status', 'Post eliminada');
    }
}
