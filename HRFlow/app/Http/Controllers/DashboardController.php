<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Formation;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalHR = User::where('role_id', 2)->count();
        $totalEmployees = User::where('role_id', 3)->count(); 
        $totalManagers = User::where('role_id', 1)->count(); 
    
        $totalFormations = Formation::count();
    
        return view('dashboard', compact('totalHR', 'totalEmployees', 'totalManagers', 'totalFormations'));
    }
    
}
