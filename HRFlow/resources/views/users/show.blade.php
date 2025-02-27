@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Détails de l'Utilisateur</h1>

    <div class="bg-white shadow-xl sm:rounded-xl p-8 space-y-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-700">Informations de l'utilisateur</h2>
            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Retour à la liste</a>
        </div>

        <!-- Informations générales de l'utilisateur -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Nom -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Nom :</strong>
                <p class="text-sm text-gray-600">{{ $user->name }}</p>
            </div>

            <!-- Email -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Email :</strong>
                <p class="text-sm text-gray-600">{{ $user->email }}</p>
            </div>

            <!-- Rôle -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Rôle :</strong>
                <p class="text-sm text-gray-600">{{ $user->role ? $user->role->name : 'Aucun rôle' }}</p>
            </div>

            <!-- Grade -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Grade :</strong>
                <p class="text-sm text-gray-600">{{ $user->grade ? $user->grade->name : 'Non attribué' }}</p>
            </div>

            <!-- Contrat -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Contrat :</strong>
                <p class="text-sm text-gray-600">{{ $user->contract ? $user->contract->name : 'Non spécifié' }}</p>
            </div>

            <!-- Département -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Département :</strong>
                <p class="text-sm text-gray-600">{{ $user->department ? $user->department->name : 'Non spécifié' }}</p>
            </div>

            <!-- Poste -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Poste :</strong>
                <p class="text-sm text-gray-600">{{ $user->post ? $user->post->name : 'Non attribué' }}</p>
            </div>
        </div>

        <!-- Informations supplémentaires -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Salaire -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Salaire :</strong>
                <p class="text-sm text-gray-600">{{ $user->salary ? number_format($user->salary, 2) . ' €' : 'Non renseigné' }}</p>
            </div>

            <!-- Date de naissance -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Date de naissance :</strong>
                <p class="text-sm text-gray-600">{{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('d/m/Y') : 'Non renseignée' }}</p>
            </div>

            <!-- Adresse -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Adresse :</strong>
                <p class="text-sm text-gray-600">{{ $user->address ? $user->address : 'Non renseignée' }}</p>
            </div>

            <!-- Date d'embauche -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Date d'embauche :</strong>
                <p class="text-sm text-gray-600">{{ $user->hire_date ? \Carbon\Carbon::parse($user->hire_date)->format('d/m/Y') : 'Non renseignée' }}</p>
            </div>

            <!-- Téléphone -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Téléphone :</strong>
                <p class="text-sm text-gray-600">{{ $user->phone ? $user->phone : 'Non renseigné' }}</p>
            </div>

            <!-- Statut -->
            <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                <strong class="text-lg text-gray-700">Statut :</strong>
                <p class="text-sm text-gray-600">{{ $user->status ? ucfirst($user->status) : 'Non renseigné' }}</p>
            </div>
        </div>

        <!-- Informations de dates -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-md">
            <strong class="text-lg text-gray-700">Date de création :</strong>
            <p class="text-sm text-gray-600">{{ $user->created_at->format('d/m/Y') }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg shadow-md">
            <strong class="text-lg text-gray-700">Dernière mise à jour :</strong>
            <p class="text-sm text-gray-600">{{ $user->updated_at->format('d/m/Y') }}</p>
        </div>
    </div>
</div>
@endsection
