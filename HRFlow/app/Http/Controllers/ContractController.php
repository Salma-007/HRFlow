<?php
namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    // Afficher tous les contrats
    public function index()
    {
        $contracts = Contract::all();
        return view('contracts.index', compact('contracts'));
    }

    // Afficher le formulaire de création d'un contrat
    public function create()
    {
        return view('contracts.create');
    }

    // Enregistrer un nouveau contrat
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Contract::create([
            'name' => $request->name,
        ]);

        return redirect()->route('contracts.index')->with('success', 'Contrat créé avec succès.');
    }

    // Afficher le formulaire d'édition d'un contrat
    public function edit(Contract $contract)
    {
        return view('contracts.edit', compact('contract'));
    }

    // Mettre à jour un contrat
    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $contract->update([
            'name' => $request->name,
        ]);

        return redirect()->route('contracts.index')->with('success', 'Contrat mis à jour avec succès.');
    }

    // Supprimer un contrat
    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contracts.index')->with('success', 'Contrat supprimé avec succès.');
    }
}
