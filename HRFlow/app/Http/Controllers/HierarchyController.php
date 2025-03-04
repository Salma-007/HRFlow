<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class HierarchyController extends Controller
{
    public function index()
    {

        $admins = User::where('role_id', 1)->get(); 
        $rhes = User::where('role_id', 2)->get(); 
        $departments = Department::with(['responsable', 'employees'])->get();

        return view('hierarchy.index', compact('admins', 'rhes', 'departments'));
    }
}
