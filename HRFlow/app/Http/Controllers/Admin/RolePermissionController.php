<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(4);  
        $permissions = Permission::all();
        return view('admin.roles_permissions.index', compact('roles', 'permissions'));
    }


    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
        ]);
    
        $role = Role::create([
            'name' => $request->name,
        ]);
    
        if ($request->has('permissions')) {
            $permissions = Permission::find($request->permissions); 
            $role->givePermissionTo($permissions); 
        }
    
        return back()->with('success', 'Rôle créé avec succès !');
    }
    

    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);
    
        $permission = Permission::create([
            'name' => $request->name,
        ]);
    
        return redirect()->route('admin.roles_permissions.index')->with('success', 'La permission a été créée avec succès.');
    }

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray(); 

        return view('admin.roles_permissions.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        if ($request->has('permissions')) {
            $permissions = Permission::find($request->permissions); 
            $role->syncPermissions($permissions); 
        } else {
            $role->syncPermissions([]); 
        }

        return redirect()->route('admin.roles_permissions.index')->with('success', 'Rôle mis à jour avec succès.');
    }

    // Méthode pour supprimer un rôle
    public function destroyRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return back()->with('success', 'Rôle supprimé avec succès.');
    }

    // Méthode pour supprimer une permission
    public function destroyPermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return back()->with('success', 'Permission supprimée avec succès.');
    }
}
