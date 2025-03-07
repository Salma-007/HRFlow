@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-center mb-6 text-gray-800">Mes Demandes de Récupération</h1>

    <div class="text-center mb-6">
        <a href="{{ route('recoveries.create') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">
            Ajouter une Demande de Récupération
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
        <p class="text-lg">Solde de récupération actuel : <strong class="text-green-500">{{ Auth::user()->solde_recup }} jours</strong></p>
    </div>

    @foreach ($recoveries as $recovery)
        <div class="mb-6 p-4 border rounded-lg shadow-md {{ $recovery->status == 'accepted' ? 'bg-green-100' : ($recovery->status == 'refused' ? 'bg-red-100' : 'bg-yellow-100') }}">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold text-gray-700">{{ $recovery->date_debut }} au {{ $recovery->date_fin }}</p>
                    <p class="text-md text-gray-500">Statut : <span class="font-semibold {{ $recovery->status == 'accepted' ? 'text-green-600' : ($recovery->status == 'refused' ? 'text-red-600' : 'text-yellow-600') }}">{{ ucfirst($recovery->status) }}</span></p>
                </div>
                @if ($recovery->status == 'pending')
                    <span class="text-sm text-gray-500">En attente d'approbation</span>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
