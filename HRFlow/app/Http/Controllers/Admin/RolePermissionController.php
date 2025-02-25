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
        $roles = Role::paginate(3);  
        $permissions = Permission::paginate(3);
        return view('admin.roles_permissions.index', compact('roles', 'permissions'));
    }


    public function storeRole(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id', // Vérifie que l'ID existe
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
