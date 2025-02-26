@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Liste des Contrats</h1>
    <a href="{{ route('contracts.create') }}" class="mb-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Créer un Contrat</a>
    
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($contracts as $contract)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $contract->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('contracts.edit', $contract->id) }}" class="text-indigo-600 hover:text-indigo-900">Éditer</a>
                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
