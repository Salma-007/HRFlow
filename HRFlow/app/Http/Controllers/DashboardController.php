<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        
        $user = auth()->user();
        $leaveDays = $this->calculateLeaveDays($user);

        return view('dashboard', compact('totalHR', 'totalEmployees', 'totalManagers', 'totalFormations', 'leaveDays'));
    }

    public function calculateLeaveDays(User $user)
    {
        $hireDate = Carbon::parse($user->hire_date);
        $currentDate = Carbon::now();

        $yearsWorked = $hireDate->diffInYears($currentDate);
        $monthsWorked = $hireDate->diffInMonths($currentDate);

        if ($yearsWorked < 1) {
            $leaveDays = 1.5 * $monthsWorked;
        } else {
            $leaveDays = 18 + (0.5 * $yearsWorked);
        }

        return $leaveDays;
    }
    
}
