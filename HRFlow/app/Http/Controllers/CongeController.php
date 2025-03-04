<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Conge;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CongeController extends Controller
{
    public function index()
    {
        $conges = Conge::paginate(9); 
        return view('conges.index', compact('conges')); 
    }

    public function myconges()
    {
        $conges = Conge::where('user_id', Auth::id())->get();
        return view('conges.mes-conges', compact('conges'));
    }

    public function create()
    {
        return view('conges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date|after_or_equal:' . Carbon::now()->addWeek()->toDateString(),  
            'date_fin' => 'required|date|after_or_equal:date_debut', 
        ]);

        Conge::create([
            'user_id' => Auth::id(),
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'status' => 'pending',
        ]);

        return redirect()->route('conges.mesconges')->with('success', 'Demande de congé soumise avec succès.');
    }
}
