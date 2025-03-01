@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Historique de carrière de {{ $user->name }}</h1>

    <div class="flex justify-between mb-6">
        <a href="{{ route('users.show', $user->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Retour au profil</a>
        <a href="{{ route('carrieres.create', ['user_id' => $user->id]) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Ajouter une nouvelle carrière</a>
    </div>

    <!-- Carrière actuelle -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Situation actuelle</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Grade</p>
                <p class="font-medium">{{ $user->grade->name ?? 'Non défini' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Poste</p>
                <p class="font-medium">{{ $user->post->name ?? 'Non défini' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Département</p>
                <p class="font-medium">{{ $user->department->name ?? 'Non défini' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Contrat</p>
                <p class="font-medium">{{ $user->contract->name ?? 'Non défini' }}</p>
            </div>
        </div>
    </div>

    <!-- Historique des carrières -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Historique des évolutions</h2>
        
        @if($carrieres->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left">Période</th>
                            <th class="px-4 py-2 text-left">Grade</th>
                            <th class="px-4 py-2 text-left">Poste</th>
                            <th class="px-4 py-2 text-left">Contrat</th>
                            <th class="px-4 py-2 text-left">Formation</th>
                            <th class="px-4 py-2 text-left">Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carrieres as $carriere)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="font-medium">{{ $carriere->date_debut->format('d/m/Y') }}</div>
                                    <div class="text-sm text-gray-600">
                                        @if($carriere->date_fin)
                                            au {{ $carriere->date_fin->format('d/m/Y') }}
                                        @else
                                            <span class="text-green-600">En cours</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3">{{ $carriere->grade->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $carriere->post->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $carriere->contract->name ?? 'N/A' }}</td>
                                <td class="px-4 py-3">{{ $carriere->formation->name ?? 'Aucune' }}</td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('carrieres.show', $carriere->id) }}" class="text-blue-600 hover:underline">Voir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 italic">Aucun historique de carrière disponible.</p>
        @endif
    </div>
</div>
@endsection