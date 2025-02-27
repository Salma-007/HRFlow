@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Documents</h1>

    <a href="{{ route('documents.create') }}" class="inline-block px-6 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300 mb-6">Ajouter un Document</a>

    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="min-w-full table-auto text-gray-700">
            <thead class="bg-blue-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nom Utilisateur</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nom Contrat</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Date de début</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Date de fin</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Statut</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Lien</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr class="border-t hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4 text-sm">{{ $document->user->name }}</td>
                        <td class="px-6 py-4 text-sm">{{ $document->contract->name }}</td>
                        <td class="px-6 py-4 text-sm">{{ $document->start_date }}</td>
                        <td class="px-6 py-4 text-sm">{{ $document->end_date }}</td>
                        <td class="px-6 py-4 text-sm">{{ $document->status }}</td>
                        <td class="px-6 py-4 text-sm"><a href="{{ $document->link }}" target="_blank" class="text-blue-600 hover:underline">Voir</a></td>
                        <td class="px-6 py-4 text-sm space-x-4">
                            <a href="{{ route('documents.edit', $document->id) }}" class="text-yellow-600 hover:text-yellow-700 font-semibold">Modifier</a>
                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
