<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\User;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('responsable')->paginate(7);  
        return view('departments.index', compact('departments'));
    }
    

    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');  
        })->get();
        return view('departments.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'responsable_id' => 'nullable|exists:users,id',  
        ]);
    
        Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'responsable_id' => $request->responsable_id, 
        ]);
    
        return redirect()->route('departments.index')->with('success', 'Département créé avec succès');
    }
    

    public function show($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.show', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'manager');  
        })->get();
        return view('departments.edit', compact('department', 'users'));  
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'responsable_id' => 'nullable|exists:users,id',  
        ]);
    
        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
            'description' => $request->description,
            'responsable_id' => $request->responsable_id,  
        ]);
    
        return redirect()->route('departments.index')->with('success', 'Département mis à jour avec succès');
    }
    

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Département supprimé avec succès');
    }
}
