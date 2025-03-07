@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Historique de carrière de {{ $user->name }}</h1>

    <div class="flex justify-between mb-6">
        <a href="{{ route('users.show', $user->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Retour au profil</a>
        @can('manage users')
        <a href="{{ route('carrieres.create', ['user_id' => $user->id]) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Ajouter une nouvelle carrière</a>
        @endcan
    </div>

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

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4">Historique des évolutions</h2>
        
        @if($carrieres->count() > 0)
            <div class="relative">

                <div class="absolute left-4 right-4 top-4 h-1 bg-gray-300"></div>

                <div class="flex justify-between">
                    @foreach($carrieres as $carriere)
                        <div class="relative flex flex-col items-center">
                            <a href="{{ route('carrieres.show', $carriere->id) }}" class="block w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition duration-300">
                                <span class="text-sm">{{ $loop->iteration }}</span>
                            </a>

                            <div class="mt-2 text-center">
                                <p class="text-sm font-medium">{{ $carriere->post->name ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-600">{{ $carriere->grade->name ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ $carriere->date_debut->format('d/m/Y') }}
                                    @if($carriere->date_fin)
                                        - {{ $carriere->date_fin->format('d/m/Y') }}
                                    @else
                                        <span class="text-green-600"> (En cours)</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <p class="text-gray-500 italic">Aucun historique de carrière disponible.</p>
        @endif
    </div>
</div>
@endsection