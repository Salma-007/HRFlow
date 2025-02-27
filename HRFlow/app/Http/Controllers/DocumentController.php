<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\Contract;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with(['user', 'contract'])->get();
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $users = User::all();
        $contracts = Contract::all();
        return view('documents.create', compact('users', 'contracts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'contract_id' => 'required|exists:contracts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:actif,expiré,suspendu,terminé,réssilié,renouvelé',
            'link' => 'required|url',
        ]);

        Document::create([
            'user_id' => $request->user_id,
            'contract_id' => $request->contract_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'link' => $request->link,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document created successfully.');
    }

    public function edit(Document $document)
    {
        $users = User::all();
        $contracts = Contract::all();
        return view('documents.edit', compact('document', 'users', 'contracts'));
    }

    public function update(Request $request, Document $document)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'contract_id' => 'required|exists:contracts,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:actif,expiré,suspendu,terminé,réssilié,renouvelé',
            'link' => 'required|url',
        ]);

        $document->update([
            'user_id' => $request->user_id,
            'contract_id' => $request->contract_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'link' => $request->link,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document updated successfully.');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}
