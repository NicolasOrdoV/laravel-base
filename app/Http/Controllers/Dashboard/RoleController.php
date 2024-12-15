<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\PutRequest;
use App\Http\Requests\Role\StoreRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('is-admin');
        $roles = Role::paginate(2);
        return view('dashboard.role.index', compact('roles'));
        //dd($post->role->title);
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
        $role = new Role();
        return view('dashboard.role.create', compact('role'));
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
        Role::create(
            [
                'name' => $request->name,
            ]
        );
        return to_route('role.index')->with('status', 'Rol creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        Gate::authorize('is-admin');
        return view('dashboard.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        Gate::authorize('is-admin');
        return view('dashboard.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Role $role)
    {
        Gate::authorize('is-admin');
        $data = $request->validated();
        $role->update($data);
        return to_route('role.index')->with('status', 'Rol actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Gate::authorize('is-admin');
        $role->delete();
        return to_route('role.index')->with('status', 'Role delete');
    }
}
