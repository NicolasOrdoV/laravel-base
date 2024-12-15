<?php

namespace App\View\Components\Dashboard\user\role\permission;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Manage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public User $user)
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.user.role.permission.manage', ['roles' => Role::get(), 'permissions' => Permission::get()]);
    }

    public function handleRole(User $user)
    {
        Gate::authorize('is-admin');
        $role = Role::findOrFail(request('role'));
        $user->assignRole($role);

        if (request()->ajax()) {
            //axios, jquery ajax fetch...
            return response()->json($role);
        } else {
            //form
            return redirect()->back();
        }
    }

    public function deleteRole(User $user)
    {
        Gate::authorize('is-admin');
        $role = Role::findOrFail(request('role'));
        $user->removeRole($role);
        if (request()->ajax()) {
            return response()->json($role);
        } else {
            return redirect()->back();
        }
    }

    public function handlePermission(User $user)
    {
        Gate::authorize('is-admin');
        //dd("llego aca");
        $permission = Permission::findOrFail(request('permission'));
        $user->givePermissionTo($permission);
        if (request()->ajax()) {
            return response()->json($permission);
        } else {
            return redirect()->back();
        }
    }

    public function deletePermission(User $user)
    {
        Gate::authorize('is-admin');
        $permission = Permission::findOrFail(request('permission'));
        $user->revokePermissionTo($permission);
        if (request()->ajax()) {
            return response()->json($permission);
        } else {
            return redirect()->back();
        }
    }
}
