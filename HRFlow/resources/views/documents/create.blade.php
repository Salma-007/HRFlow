@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white shadow-lg rounded-lg mt-3">
    <h1 class="text-4xl font-semibold text-gray-800 mb-8 text-center">Créer un Document</h1>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md">
            <strong class="font-bold">Erreur!</strong>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('documents.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Utilisateur</label>
                <select id="user_id" name="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="contract_id" class="block text-sm font-medium text-gray-700">Contrat</label>
                <select id="contract_id" name="contract_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($contracts as $contract)
                        <option value="{{ $contract->id }}">{{ $contract->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                <input type="date" id="start_date" name="start_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                <input type="date" id="end_date" name="end_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="actif">Actif</option>
                <option value="expiré">Expiré</option>
                <option value="suspendu">Suspendu</option>
                <option value="terminé">Terminé</option>
                <option value="résilié">Résilié</option>
                <option value="renouvelé">Renouvelé</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="link" class="block text-sm font-medium text-gray-700">Lien du Document</label>
            <input type="url" id="link" name="link" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="mt-6 flex justify-center">
            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Créer le Document
            </button>
        </div>
    </form>
</div>
@endsection
