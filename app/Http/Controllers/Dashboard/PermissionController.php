<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PutRequest;
use App\Http\Requests\Permission\StoreRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('is-admin');
        $permissions = Permission::paginate(10);
        return view('dashboard.permission.index', compact('permissions'));
        //dd($post->permission->title);
        // $post->update(
        //     [
        //         'title' => 'test title new',
        //         'slug' => 'test slug',
        //         'content' => 'test contrent',
        //         'role_id' => 1,
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
        Gate::authorize('is-admin');
        $permission = new Permission();
        return view('dashboard.permission.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Gate::authorize('is-admin');
        // $validated = Validator::make($request->all(), [
        //     'title' => 'required|min:5|min:500',
        //     'slug' => 'required|min:5|min:500'
        // ]);
        // $request->validate([
        //     'title' => 'required|min:5|min:500',
        //     'slug' => 'required|min:5|min:500',
        //     'content' => 'required|min:7',
        //     'role_id' => 'required|integer',
        //     'description' => 'required|min:7',
        //     'posted' => 'required'
        // ]);

        // Post::create($request->all()); otra forma de insertar
        Permission::create(
            [
                'name' => $request->name,
            ]
        );
        return to_route('permission.index')->with('status', 'Permiso creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        Gate::authorize('is-admin');
        return view('dashboard.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        Gate::authorize('is-admin');
        return view('dashboard.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Permission $permission)
    {
        Gate::authorize('is-admin');
        $data = $request->validated();
        $permission->update($data);
        return to_route('permission.index')->with('status', 'Permiso actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        Gate::authorize('is-admin');
        $permission->delete();
        return to_route('permission.index')->with('status', 'Permission delete');
    }
}
