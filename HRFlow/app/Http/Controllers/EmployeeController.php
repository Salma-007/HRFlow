<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('roles')->paginate(10);  
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $roles = Role::all(); 
        $departments = Department::all();  
        return view('employees.create', compact('roles', 'departments'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'contract_type' => 'required|in:CDD,CDI,stage',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'hire_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'department_id' => 'required|exists:departments,id', 
            'role' => 'required|exists:roles,id', 
        ]);

        $employee = Employee::create($request->all());
        $rolee = Role::find($request->role);
        $employee->assignRole($rolee);

        return redirect()->route('employees.index')->with('success', 'Employé créé avec succès!');
    }
}
