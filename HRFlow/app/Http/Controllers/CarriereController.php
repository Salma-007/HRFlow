<?php

namespace App\Http\Controllers;

use App\Models\Carriere;
use App\Models\User;
use App\Models\Grade;
use App\Models\Formation;
use App\Models\Contract;
use App\Models\Post;
use App\Models\Department;
use Illuminate\Http\Request;

class CarriereController extends Controller
{
    public function index()
    {
        $carrieres = Carriere::with(['user', 'grade', 'formation', 'contract', 'post'])->get();
        return view('carrieres.index', compact('carrieres'));
    }

    public function create(Request $request)
    {
        $user_id = $request->user_id; 
        $user = User::findOrFail($user_id);
        
        $grades = Grade::all();
        $formations = Formation::all();
        $contracts = Contract::all();
        $departments = Department::all();
        $posts = Post::all();
        
        return view('carrieres.create', compact('user', 'grades', 'formations', 'contracts', 'departments', 'posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'grade_id' => 'required|exists:grades,id',
            'formation_id' => 'nullable|exists:formations,id',
            'contract_id' => 'required|exists:contracts,id',
            'department_id' => 'required|exists:departments,id',
            'post_id' => 'required|exists:posts,id',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'commentaire' => 'nullable|string',
        ]);

        $userCurrentCarriere = Carriere::where('user_id', $request->user_id)
            ->whereNull('date_fin')
            ->first();
            
        if ($userCurrentCarriere) {
            $userCurrentCarriere->update([
                'date_fin' => $request->date_debut,
            ]);
        }

        Carriere::create([
            'user_id' => $request->user_id,
            'grade_id' => $request->grade_id,
            'formation_id' => $request->formation_id,
            'contract_id' => $request->contract_id,
            'post_id' => $request->post_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'commentaire' => $request->commentaire,
        ]);

        $user = User::find($request->user_id);
        $user->update([
            'grade_id' => $request->grade_id,
            'contract_id' => $request->contract_id,
            'department_id' => $request->department_id,
            'post_id' => $request->post_id,
        ]);

        return redirect()->route('users.carrieres', $request->user_id)
            ->with('success', 'Carrière ajoutée avec succès.');
    }

    public function userCarrieres($userId)
    {
        $user = User::findOrFail($userId);
        $carrieres = Carriere::with(['grade', 'formation', 'contract', 'post'])
            ->where('user_id', $userId)
            ->orderBy('date_debut', 'desc')
            ->get();
            
        return view('carrieres.user_carrieres', compact('user', 'carrieres'));
    }

    public function show(Carriere $carriere)
    {
        $carriere->load(['user', 'grade', 'formation', 'contract', 'post']);
        return view('carrieres.show', compact('carriere'));
    }

    public function getPostsByDepartment($departmentId)
    {
        $posts = Post::where('department_id', $departmentId)->get();
        return response()->json($posts);
    }
}