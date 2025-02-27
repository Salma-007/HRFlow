@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header avec navigation -->
    <div class="bg-white shadow">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Profil Utilisateur</h1>
                    <p class="text-gray-500">{{ $user->name }}</p>
                </div>
                <a href="{{ route('users.index') }}" class="flex items-center text-blue-600 hover:text-blue-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Carte principale d'information -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="md:flex">
                <!-- Colonne de gauche avec avatar -->
                <div class="md:w-1/3 bg-blue-600 text-white p-8">
                    <div class="flex flex-col items-center">
                        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mb-4">
                            <span class="text-blue-600 text-4xl font-bold">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                        </div>
                        <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                        <p class="text-blue-200">{{ $user->role ? $user->role->name : 'Aucun rôle assigné' }}</p>
                        
                        <div class="mt-6 w-full">
                            <div class="flex items-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                                <span class="text-sm">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span class="text-sm">{{ $user->phone ? $user->phone : 'Non renseigné' }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm">{{ $user->address ? $user->address : 'Non renseignée' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Colonne de droite avec informations -->
                <div class="md:w-2/3 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations professionnelles -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Informations professionnelles</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Département</p>
                                    <p class="font-medium">{{ $user->department ? $user->department->name : 'Non spécifié' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Grade</p>
                                    <p class="font-medium">{{ $user->grade ? $user->grade->name : 'Non attribué' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Contrat</p>
                                    <p class="font-medium">{{ $user->contract ? $user->contract->name : 'Non spécifié' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Statut</p>
                                    <p class="font-medium">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->status == 'actif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $user->status ? ucfirst($user->status) : 'Non renseigné' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informations personnelles -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Informations personnelles</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Date de naissance</p>
                                    <p class="font-medium">{{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('d/m/Y') : 'Non renseignée' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Salaire</p>
                                    <p class="font-medium">{{ $user->salary ? number_format($user->salary, 2) . ' €' : 'Non renseigné' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date d'embauche</p>
                                    <p class="font-medium">{{ $user->hire_date ? \Carbon\Carbon::parse($user->hire_date)->format('d/m/Y') : 'Non renseignée' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Métadonnées -->
                    <div class="mt-8 pt-4 border-t">
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Créé le: {{ $user->created_at->format('d/m/Y') }}</span>
                            <span>Mis à jour le: {{ $user->updated_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection