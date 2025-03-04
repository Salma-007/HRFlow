@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Détails de carrière</h1>

    <div class="flex mb-6">
        <a href="{{ route('users.carrieres', $carriere->user_id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Retour à l'historique</a>
    </div>
    <div class="flex justify-between mt-6">
    <a href="{{ route('carrieres.edit', $carriere->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Modifier cette carrière</a>
    </div>


    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Informations générales</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Employé</p>
                    <p class="font-medium">{{ $carriere->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Période</p>
                    <p class="font-medium">
                        Du {{ $carriere->date_debut->format('d/m/Y') }}
                        @if($carriere->date_fin)
                            au {{ $carriere->date_fin->format('d/m/Y') }}
                        @else
                            (En cours)
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Détails du poste</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Grade</p>
                    <p class="font-medium">{{ $carriere->grade->name ?? 'Non défini' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Poste</p>
                    <p class="font-medium">{{ $carriere->post->name ?? 'Non défini' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Contrat</p>
                    <p class="font-medium">{{ $carriere->contract->name ?? 'Non défini' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Formation</p>
                    <p class="font-medium">{{ $carriere->formation->name ?? 'Aucune' }}</p>
                </div>
            </div>
        </div>

        @if($carriere->commentaire)
        <div>
            <h2 class="text-xl font-semibold mb-2">Commentaire</h2>
            <div class="bg-gray-50 p-4 rounded-md">
                {{ $carriere->commentaire }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection