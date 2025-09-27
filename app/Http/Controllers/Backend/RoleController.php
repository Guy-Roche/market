<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    //All Permissions
    public function permissions()
    {
        $compteur = 1;
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions', 'compteur'));
    }
    //Add Permission
    public function add()
    {
        return view('admin.permissions.add');
    }
    //Save Permission
    public function save(Request $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->group_name = $request->group_name;
        $permission->save();
        $notification = array(
            'message' => 'Permission created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('permissions')->with($notification);
    }

    //Edit Permission
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    //Update Permission
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->group_name = $request->group_name;
        $permission->save();
        $notification = array(
            'message' => 'Permission updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('permissions')->with($notification);
    }

    //Delete Permission
    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        $notification = array(
            'message' => 'Permission deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('permissions')->with($notification);
    }
    /*|-------------------Roles--------------------------------//*/

    //All Roles
    public function roles()
    {
        $compteur = 1;
        $roles = Role::all();
        return view('admin.roles.index', compact('roles', 'compteur'));
    }
    //Add Role
    public function addrole()
    {
        return view('admin.roles.add');
    }

    //Save Role
    public function saverole(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        $notification = array(
            'message' => 'Role created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('roles')->with($notification);
    }

    //Edit Role
    public function editrole($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    //Update Role
    public function updaterole(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
        $notification = array(
            'message' => 'Role updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('roles')->with($notification);
    }

    //Delete Role
    public function deleterole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $notification = array(
            'message' => 'Role deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('roles')->with($notification);
    }

    /*|-------------------Roles in Permission--------------------------------//*/

    //Add Role in Permission
    public function rolepermissionadd()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroup();
        return view('admin.roles.add_role_permission', compact('roles', 'permissions', 'permission_groups'));
    }
    //save Role in Permission
    public function rolepermissionsave(Request $request)
    {
        //Pas de model pour role_has_permissions
        //Donc on utilise le query builder
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;
            //Utilisation du query builder
            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role permissions assigned successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('rolespermissions')->with($notification);
    }
    //All Roles in Permission
    public function rolespermissions()
    {
        $compteur = 1;
        $roles = Role::all();
        return view('admin.roles.all_role_permission', compact('roles', 'compteur'));
    }
    //Edit Role in Permission
    public function rolepermissionedit($id)
    {
        $rolePermission = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroup();
        return view('admin.roles.edit_role_permission', compact('rolePermission', 'permissions', 'permission_groups'));
    }
    //Update Role in Permission
    public function rolepermissionupdate(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;            

        // //cas 1: detach all existing permissions and attach new permissions
        // //Detach all existing permissions(autre facon de faire )
        // $role->permissions()->detach();
        // //Attach new permissions
        // if ($permissions) {
        //     foreach ($permissions as $permission) {
        //         $role->permissions()->attach($permission);
        //     }
        // }

        //cas 2 sync permissions
        if (!empty($permissions)) {
            $role->permissions()->sync($permissions);
        } 
            // 🔄 Reset du cache des permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
            // ou
            // app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $notification = array(
            'message' => 'Role permissions updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('rolespermissions')->with($notification);
    }
    //Delete Role in Permission
    public function rolepermissiondelete($id)
    {
        //find role by id
        $role = Role::findOrFail($id);  
        //Detach all existing permissions
        if (!is_null($role)) {
            $role->delete();
        }
        // 🔄 Reset du cache des permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // or just
        // $role->permissions()->detach();
        $notification = array(
            'message' => 'Role permissions deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('rolespermissions')->with($notification);
    }
}
