@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-xl max-w-4xl mx-auto mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Mes Congés</h2>

    <!-- Bouton pour ajouter un nouveau congé -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('conges.create') }}" 
           class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Ajouter un nouveau congé
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($conges->isEmpty())
        <div class="text-center text-gray-500">
            Vous n'avez aucune demande de congé enregistrée.
        </div>
    @else
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date de début</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date de fin</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($conges as $conge)
                    <tr class="border-t border-gray-200">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $conge->date_debut }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $conge->date_fin }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">
                            <span 
                                class="px-3 py-1 rounded-full 
                                {{ $conge->status == 'pending' ? 'bg-yellow-200 text-yellow-700' : ($conge->status == 'accepted' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700') }}">
                                {{ ucfirst($conge->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
