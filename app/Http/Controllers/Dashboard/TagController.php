<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\PutRequest;
use App\Http\Requests\Tag\StoreRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tags = Tag::paginate(10);
        return view('dashboard.tag.index', compact('tags'));
        //dd($post->tag->title);
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

        $tag = new Tag();
        return view('dashboard.tag.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        // $validated = Validator::make($request->all(), [
        //     'title' => 'required|min:5|min:500',
        //     'slug' => 'required|min:5|min:500'
        // ]);
        // $request->validate([
        //     'title' => 'required|min:5|min:500',
        //     'slug' => 'required|min:5|min:500',
        //     'content' => 'required|min:7',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|min:7',
        //     'posted' => 'required'
        // ]);

        // Post::create($request->all()); otra forma de insertar
        Tag::create(
            [
                'name' => $request->name
            ]
        );
        return to_route('tag.index')->with('status', 'tag creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {

        return view('dashboard.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {

        return view('dashboard.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Tag $tag)
    {

        $data = $request->validated();
        $tag->update($data);
        return to_route('tag.index')->with('status', 'tag actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {

        $tag->delete();
        return to_route('tag.index')->with('status', 'Tag delete');
    }
}
