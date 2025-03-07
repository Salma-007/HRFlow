<?php

namespace App\Http\Controllers;

use App\Models\Recovery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RecoveryController extends Controller
{
    public function index()
    {
        $recoveries = Recovery::with('user')->paginate(10);
        return view('recoveries.index', compact('recoveries'));
    }

    public function myRecoveries()
    {
        $recoveries = Recovery::where('user_id', Auth::id())->get();
        return view('recoveries.my-recoveries', compact('recoveries'));
    }

    public function create()
    {
        return view('recoveries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        Recovery::create([
            'user_id' => Auth::id(),
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'status' => 'pending',
            'rh_approval' => false,
        ]);

        return redirect()->route('recoveries.myRecoveries')->with('success', 'Demande de récupération soumise avec succès.');
    }

    public function approveByRh($id)
    {
        $recovery = Recovery::findOrFail($id);

        if (Auth::user()->role_id !== 2) {
            return back()->withErrors('Vous n\'êtes pas autorisé à approuver cette demande.');
        }

        $date_debut = Carbon::parse($recovery->date_debut);
        $date_fin = Carbon::parse($recovery->date_fin);
        $duree_recup = $date_debut->diffInDays($date_fin) + 1; 

        $user = $recovery->user;
        if ($user->solde_recup < $duree_recup) {
            return back()->withErrors('L\'utilisateur n\'a pas suffisamment de jours de récupération.');
        }

        $user->solde_recup -= $duree_recup;
        $user->save();

        $recovery->rh_approval = true;
        $recovery->status = 'accepted';
        $recovery->save();
    
        return back()->with('success', 'Demande de récupération approuvée par les RH et solde de récupération mis à jour.');
    }
    

    public function rejectByRh($id)
    {
        $recovery = Recovery::findOrFail($id);

        if (Auth::user()->role_id !== 2) {
            return back()->withErrors('Vous n\'êtes pas autorisé à refuser cette demande.');
        }

        $recovery->rh_approval = false;
        $recovery->status = 'refused';
        $recovery->save();

        return back()->with('error', 'Demande de récupération refusée par les RH.');
    }

    public function updateRecovery(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'recovery_days' => 'required|integer|min:1',
        ]);

        $user = User::findOrFail($request->user_id);

        $user->solde_recup = $request->recovery_days;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Jours de récupération mis à jour avec succès.');
    }
}
