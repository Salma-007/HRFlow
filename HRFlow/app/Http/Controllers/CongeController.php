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
        $conges = Conge::whereHas('user', function ($query) {
            $query->where('department_id', Auth::user()->department_id);
        })->paginate(9);

        $allconges = Conge::paginate(9);
    
        return view('conges.index', compact('conges','allconges'));
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
            'type_conge' => 'required|in:annuel,maternite,parental,maladie',
        ]);

        $date_debut = Carbon::parse($request->date_debut);
        $date_fin = Carbon::parse($request->date_fin);
        $duree_conge = $date_debut->diffInDays($date_fin) + 1; 

        $user = Auth::user();
        $solde_conge = $user->solde_conge;

        // dd($duree_conge, $solde_conge);
    
        if ($duree_conge > $solde_conge) {
            return back()->withErrors(['date_fin' => 'La durée du congé dépasse le solde disponible de congé.'])->withInput();
        }
 
        Conge::create([
            'user_id' => Auth::id(),
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'type_conge' => $request->type_conge, 
            'status' => 'pending',
        ]);
        
        // $user->solde_conge -= $duree_conge;
        // $user->save();

        return redirect()->route('conges.mesconges')->with('success', 'Demande de congé soumise avec succès.');
    }
    
    public function approveByManager($id)
    {
        $conge = Conge::findOrFail($id);
        if (Auth::user()->departement_id != $conge->user->departement_id) {
            return back()->withErrors('Vous ne pouvez pas approuver la demande de congé de cet employé car il appartient à un autre département.');
        }

        $conge->manager_approval = true;
        $this->updateStatus($conge);

        $conge->save();
        return back()->with('success', 'Demande approuvée par le manager.');
    }

    public function approveByRh($id)
    {
        $conge = Conge::findOrFail($id);
        if (Auth::user()->departement_id != $conge->user->departement_id) {
            return back()->withErrors('Vous ne pouvez pas approuver la demande de congé de cet employé car il appartient à un autre département.');
        }

        $conge->rh_approval = true;
        $this->updateStatus($conge);

        $conge->save();
        return back()->with('success', 'Demande approuvée par les RH.');
    }

    public function rejectConge($id)
    {
        $conge = Conge::findOrFail($id);

        if (Auth::user()->departement_id != $conge->user->departement_id) {
            return back()->withErrors('Vous ne pouvez pas refuser la demande de congé de cet employé car il appartient à un autre département.');
        }

        if (Auth::user()->role_id === 1) {
            $conge->manager_approval = false;
        }

        if (Auth::user()->role_id === 2) {
            $conge->rh_approval = false; 
        }

        $this->updateStatus($conge);
    
        $conge->save();
    
        return back()->with('error', 'Demande de congé refusée.');
    }
    

    private function updateStatus($conge)
    {
        if ($conge->manager_approval === true && $conge->rh_approval === true) {
            $conge->status = 'accepted';
        } 
        elseif ($conge->manager_approval === false || $conge->rh_approval === false) {
            $conge->status = 'refused';
        } 
        else {
            $conge->status = 'pending';
        }
    }
    
}
