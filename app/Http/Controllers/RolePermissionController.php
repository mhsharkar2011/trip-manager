<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;


class RolePermissionController extends Controller
{
    //

    public function roles()
    {
        $all_roles_in_database = Role::query();

        if ($with = request('with')) { //load relationships
            $all_roles_in_database->with(explode(',', $with));
        }        
        $all_roles_in_database = $all_roles_in_database->get();

        return $this->respond($all_roles_in_database);
    }

    public function role_store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        return $this->respond($role);
    }
    public function role_update(Role $role, Request $request)
    {
        $role->update($request->all());
        return $this->respond($role);
    }
    public function role_destroy(Role $role)
    {
        $role->delete();
        return $this->respond([],'Role removed');;
    }

    // Permissions CRUD apis

    public function permissions()
    {
        $all_permissions_in_database = Permission::all();
        return $this->respond($all_permissions_in_database);
    }

    public function permission_store(Request $request)
    {
        $permission = Permission::create(['name' => $request->name]);
        return $this->respond($permission);
    }
    public function permission_update(Permission $permission, Request $request)
    {
        $permission->update($request->all());
        return $this->respond($permission);
    }
    public function permission_destroy(Permission $permission)
    {
        $permission->delete();
        return $this->respond([],'Permission removed');;
    }

    public function roles_permission_store(Role $role, Request $request)
    {
            $role->syncPermissions(request('permissionIds'));
            return $role;

    }

    public function roles_permissions(Role $role)
    {
        return $this->respond($role->permissions);

    }
    public function permissionRoles_store(Permission $permission, Request $request)
    {
        $permission->syncRoles(request('roleIds'));
        return $permission;
    }

    public function permission_roles(Permission $permission)
    {
        return $this->respond($permission->roles);

    }

    public function roles_permissions_destroy(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission);

        return $this->respond([],'Permission removed');

    }

    public function permissions_roles_destroy(Permission $permission, Role $role)
    {
        $permission->removeRole($role);

        return $this->respond([],'Role removed from this permission');

    }

    public function user_roles_store(User $user, Request $request)
    {

        $user->assignRole($request->roleId);
        return $this->respond($user->load('roles'));
    }

    public function user_roles(User $user)
    {
       return $this->respond($user->roles);
    }

    public function user_roles_destroy(User $user, Role $role)
    {
        $user->removeRole($role);
        return $this->respond([],'Role unassign for this user');
    }



    public function user_permission_store(User $user, Request $request)
    {
        $user->givePermissionTo($request->permission_name);

        return $this->respond($user->getAllPermissions());

    }

    public function user_permission_show(User $user)
    {
        return $this->respond($user->getAllPermissions());
    }

    public function user_permission_destroy(User $user, Request $request)
    {
        $user->revokePermissionTo($request->permission_name);
        return $this->respond([],'Removed permission');
    }
}
