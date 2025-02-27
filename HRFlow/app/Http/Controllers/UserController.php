<?php

namespace App\Http\Controllers;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;
use App\Models\Grade;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Post;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HasRoles;
    public function index()
    {
        $users = User::with(['grade', 'contract', 'department', 'post', 'role'])->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $grades = Grade::all();
        $contracts = Contract::all();
        $departments = Department::all();
        $posts = Post::all();
        $roles = Role::all();

        return view('users.create', compact('grades', 'contracts', 'departments', 'posts', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'salary' => 'nullable|numeric',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string',
            'hire_date' => 'nullable|date',
            'phone' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'grade_id' => $request->grade_id,
            'contract_id' => $request->contract_id,
            'department_id' => $request->department_id,
            'post_id' => $request->post_id,
            'role_id' => $request->role_id,
            'salary' => $request->salary,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'hire_date' => $request->hire_date,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);
        
        $role = Role::findById($request->role_id);
        $user->assignRole($role);
        
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function getPostsByDepartment($departmentId)
    {
        $posts = Post::where('departments_id', $departmentId)->get();
        return response()->json($posts);
    }

    public function show($id)
    {
        $user = User::with(['role', 'grade', 'contract', 'department', 'post'])->findOrFail($id);
        return view('users.show', compact('user'));
    }
    

    public function edit(User $user)
    {
        $grades = Grade::all();
        $contracts = Contract::all();
        $departments = Department::all();
        $posts = Post::all();
        $roles = Role::all();

        return view('users.edit', compact('user', 'grades', 'contracts', 'departments', 'posts', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'salary' => 'nullable|numeric',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string',
            'hire_date' => 'nullable|date',
            'phone' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'grade_id' => $request->grade_id,
            'contract_id' => $request->contract_id,
            'department_id' => $request->department_id,
            'post_id' => $request->post_id,
            'role_id' => $request->role_id,
            'salary' => $request->salary,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'hire_date' => $request->hire_date,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        $role = Role::findById($request->role_id);
        $user->assignRole($role);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
