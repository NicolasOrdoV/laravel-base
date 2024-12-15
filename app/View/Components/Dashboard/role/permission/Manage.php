<?php

namespace App\View\Components\Dashboard\role\permission;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Manage extends Component
{
    public $role;
    /**
     * Create a new component instance.
     */
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.role.permission.manage', ['permissionsRole' => $this->role->permissions, 'permissions' => Permission::get()]);
    }

    public function handle(Role $role)
    {
        Gate::authorize('is-admin');
        $permission = Permission::findOrFail(request('permission'));
        $role->givePermissionTo($permission);
        if (request()->ajax()) {
            return response()->json($permission);
        } else {
            return redirect()->back();
        }
    }

    public function delete(Role $role)
    {
        Gate::authorize('is-admin');
        $permission = Permission::findOrFail(request('permission'));
        $role->revokePermissionTo($permission);
        if (request()->ajax()) {
            return response()->json($permission);
        } else {
            return redirect()->back();
        }
    }
}
