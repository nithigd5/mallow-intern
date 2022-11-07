<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    function createRole()
    {
        Gate::authorize('create-role' , Auth::user());
        $permissions = \Spatie\Permission\Models\Permission::all();
        return view('permissions.create-role' , ['permissions' => $permissions]);
    }

    function editRole(Role $role)
    {
        Gate::authorize('edit-role' , [Auth::user() , $role->name]);
        $permissions = \Spatie\Permission\Models\Permission::all();
        return view('permissions.edit-role' , ['permissions' => $permissions , 'role' => $role]);
    }

    function viewAllRoles()
    {
        Gate::authorize('view-roles' , Auth::user());

        $roles = Role::all();
        return view('permissions.roles' , ['roles' => $roles]);
    }

    function viewAllUserRoles()
    {
        Gate::authorize('view-user-roles' , Auth::user());

        $users = User::all();
        return view('permissions.user-roles' , ['users' => $users]);
    }

    function assignRole()
    {
        Gate::authorize('assign-role' , Auth::user());

        $users = User::all();
        $roles = Role::all();
        return view('permissions.assign-role' , ['users' => $users , 'roles' => $roles]);
    }

    function storeAssignRole(Request $request)
    {
        Gate::authorize('assign-role' , Auth::user());
        $request->validate([
            'user' => 'required' ,
            'role' => 'required'
        ]);
        $user = User::findOrFail($request->user);
        $user->assignRole($request->role);
        return redirect('/dashboard/roles/users');
    }

    function storeRole(Request $request)
    {
        Gate::authorize('assign-role' , Auth::user());

//        $request->validate([
//            'role' => 'required|string|unique:roles,name',
//        ]);
        $role = Role::findOrCreate($request->role);
        foreach (Permission::all() as $permission) {
            if ($request->input($permission->name) === 'on') {
                $role->givePermissionTo($permission);
            }
        }
        return redirect('/dashboard/roles');
    }

    function updateRole(Role $role, Request $request)
    {

        Gate::authorize('edit-role' , [Auth::user() , $role->name]);

//        $request->validate([
//            'role' => 'required|string|unique:roles,name',
//        ]);
        $role = Role::findOrCreate($request->role);
        foreach (Permission::all() as $permission) {
            if ($request->input($permission->name) === 'on') {
                $role->givePermissionTo($permission);
            }else{
                $role->revokePermissionTo($permission);
            }
        }
        return redirect('/dashboard/roles');
    }

    function revokeRole(User $user, Role $role)
    {
        Gate::authorize('revoke-role' , [Auth::user() , $role->name]);
        $user->removeRole($role);
        return redirect('/dashboard/roles/users');
    }
}
