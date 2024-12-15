<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PutRequest;
use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$users = User::paginate(10);
        // if(!Auth::user()->hasPermissionTo('editor.user.index')) {
        //     return abort(403);
        // }
        $users = User::when(Auth::user()->hasRole('Admin'), function ($query, $isAdmin){
            return $query->where('rol','regular');
        })->paginate(10);
        return view('dashboard.user.index', compact('users'));
        //dd($post->user->title);
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
        // if(!Auth::user()->hasPermissionTo('editor.user.create')) {
        //     return abort(403);
        // }

        $user = new User();
        return view('dashboard.user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // $request->validate([
        //     'title' => 'required|min:5|min:500',
        //     'slug' => 'required|min:5|min:500',
        //     'content' => 'required|min:7',
        //     'category_id' => 'required|integer',
        //     'description' => 'required|min:7',
        //     'posted' => 'required'
        // ]);

        // Post::create($request->all()); otra forma de insertar
        // if(!Auth::user()->hasPermissionTo('editor.user.store')) {
        //     return abort(403);
        // }
        $data = $request->validated();
        User::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'rol' => 'admin'
            ]
        );
        return to_route('user.index')->with('status', 'User creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // if(!Auth::user()->hasPermissionTo('editor.user.show')) {
        //     return abort(403);
        // }
        return view('dashboard.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // if(!Auth::user()->hasPermissionTo('editor.user.update')) {
        //     return abort(403);
        // }
       // Gate::authorize('update-view-user-admin', $user, ['editor.user.update']);
        return view('dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, User $user)
    {
        // if(!Auth::user()->hasPermissionTo('editor.user.update')) {
        //     return abort(403);
        // }
        //Gate::authorize('update-view-user-admin', $user, ['editor.user.update']);
        $data = $request->validated();
        $user->update($data);
        return to_route('user.index')->with('status', 'Usuario actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // if(!Auth::user()->hasPermissionTo('editor.user.destroy')) {
        //     return abort(403);
        // }
        //Gate::authorize('update-view-user-admin', $user, ['editor.user.destroy']);
        $user->delete();
        return to_route('user.index')->with('status', 'User delete');
    }
}
