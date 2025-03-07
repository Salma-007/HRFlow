<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Mail\AssignFormationMail;
use Illuminate\Support\Facades\Mail;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::paginate(5);
        return view('formations.index', compact('formations'));
    }

    public function create()
    {
        $users = User::all();
        return view('formations.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:presentiel,en ligne',
            'users' => 'required|array', 
            'users.*' => 'exists:users,id', 
        ]);

        $formation = Formation::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        $formation->users()->attach($request->users); 
        
        foreach ($request->users as $userId) {
            $user = User::find($userId);  
            Mail::to($user->email)->send(new AssignFormationMail($user, $formation));
        }

        return redirect()->route('formations.index')->with('success', 'Formation créée avec succès');
    }

    public function edit(Formation $formation)
    {
        $users = User::all();
        return view('formations.edit', compact('formation', 'users'));
    }

    public function update(Request $request, Formation $formation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:presentiel,en ligne',
            'users' => 'required|array', 
            'users.*' => 'exists:users,id',
        ]);

        $formation->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        $formation->users()->sync($request->users);

        return redirect()->route('formations.index')->with('success', 'Formation mise à jour avec succès');
    }

    public function destroy(Formation $formation)
    {
        $formation->delete();
        return redirect()->route('formations.index')->with('success', 'Formation supprimée avec succès');
    }

    public function showUsers(Formation $formation)
    {
        $users = $formation->users;
        return view('formations.users', compact('formation', 'users'));
    }
}
