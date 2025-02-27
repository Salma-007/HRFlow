<!-- resources/views/documents/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Modifier Document</h1>

    <form action="{{ route('documents.update', $document->id) }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- User Select -->
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Utilisateur</label>
                <select id="user_id" name="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $document->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Contract Select -->
            <div class="mb-4">
                <label for="contract_id" class="block text-sm font-medium text-gray-700">Contrat</label>
                <select id="contract_id" name="contract_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($contracts as $contract)
                        <option value="{{ $contract->id }}" {{ $contract->id == $document->contract_id ? 'selected' : '' }}>{{ $contract->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Start Date -->
            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                <input type="date" id="start_date" name="start_date" value="{{ $document->start_date }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- End Date -->
            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                <input type="date" id="end_date" name="end_date" value="{{ $document->end_date }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="actif" {{ $document->status == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="expiré" {{ $document->status == 'expiré' ? 'selected' : '' }}>Expiré</option>
                <option value="suspendu" {{ $document->status == 'suspendu' ? 'selected' : '' }}>Suspendu</option>
                <option value="terminé" {{ $document->status == 'terminé' ? 'selected' : '' }}>Terminé</option>
                <option value="résilié" {{ $document->status == 'résilié' ? 'selected' : '' }}>Résilié</option>
                <option value="renouvelé" {{ $document->status == 'renouvelé' ? 'selected' : '' }}>Renouvelé</option>
            </select>
        </div>

        <!-- Document Link -->
        <div class="mb-4">
            <label for="link" class="block text-sm font-medium text-gray-700">Lien du Document</label>
            <input type="url" id="link" name="link" value="{{ $document->link }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="mt-6">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Mettre à jour le Document</button>
        </div>
    </form>
</div>
@endsection
