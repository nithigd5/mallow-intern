<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    function createRole()
    {
        Gate::authorize('create-role' , ['']);

        $permissions = \Spatie\Permission\Models\Permission::all();
        return view('permissions.create-role' , ['permissions' => $permissions]);
    }

    function editRole(Role $role)
    {
        Gate::authorize('edit-role' , [$role->name]);
        $permissions = \Spatie\Permission\Models\Permission::all();
        return view('permissions.edit-role' , ['permissions' => $permissions , 'role' => $role]);
    }

    function viewAllRoles()
    {
        Gate::authorize('view-roles');

        $roles = Role::all();
        return view('permissions.roles' , ['roles' => $roles]);
    }

    function viewAllUserRoles()
    {
        Gate::authorize('view-user-roles');

        $users = User::all();
        return view('permissions.user-roles' , ['users' => $users]);
    }

    function assignRole()
    {
        Gate::authorize('assign-role' , ['']);

        $users = User::all();
        $roles = Role::all();
        return view('permissions.assign-role' , ['users' => $users , 'roles' => $roles]);
    }

    function storeAssignRole(Request $request)
    {
        Gate::authorize('assign-role' , [$request->input('superAdmin') === 'on' ? 'superAdmin' : '']);
        $request->validate([
            'user' => 'required' ,
        ]);

        $user = User::findOrFail($request->user);

        foreach (Role::all() as $role) {
            if ($request->input($role->name) === 'on') {
                $user->assignRole($role);
            }
        }

        $user->assignRole($request->role);
        return redirect('/dashboard/roles/users');
    }


    function editAssignRole(User $user)
    {
        Gate::authorize('assign-role' , ['']);

        $roles = Role::all();

        return view('permissions.edit-assigned-role' , ['user' => $user , 'roles' => $roles]);
    }

    function updateAssignRole(User $user , Request $request)
    {
        Gate::authorize('assign-role' , [$request->input('superAdmin') === 'on' ? 'superAdmin' : '']);

        foreach (Role::all() as $role) {
            if ($request->input($role->name) === 'on') {
                $user->assignRole($role);
            } else {
                $user->removeRole($role);
            }
        }

        $user->assignRole($request->role);
        return redirect('/dashboard/roles/users');
    }

    function storeRole(Request $request)
    {
        Gate::authorize('create-role' , [$request->role]);

        $role = Role::findOrCreate($request->role);
        foreach (Permission::all() as $permission) {
            if ($request->input($permission->name) === 'on') {
                $role->givePermissionTo($permission);
            }
        }
        return redirect('/dashboard/roles');
    }

    function updateRole(Role $role , Request $request)
    {
        Gate::authorize('edit-role' , [$request->role]);
        $role->name = $request->role;
        $role->save();

        foreach (Permission::all() as $permission) {
            if ($request->input($permission->name) === 'on') {
                $role->givePermissionTo($permission);
            } else {
                $role->revokePermissionTo($permission);
            }
        }
        return redirect('/dashboard/roles');
    }


    function deleteRole(Role $role)
    {
        Gate::authorize('delete-role' , [$role->name]);
        if($role->name ===  'superAdmin') abort(400, 'Please dont delete a Super Admin');

        $role->deleteOrFail();
        return redirect('/dashboard/roles');
    }
}
