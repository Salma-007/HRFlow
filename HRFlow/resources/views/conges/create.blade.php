@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-xl max-w-md mx-auto mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 text-center mb-4">Demande de Congé</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 mb-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('conges.store') }}" method="POST">
        @csrf

        <!-- Date de début -->
        <div>
            <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
            <input type="date" id="date_debut" name="date_debut" required
                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                value="{{ old('date_debut') }}">
            @error('date_debut')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date de fin -->
        <div>
            <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
            <input type="date" id="date_fin" name="date_fin" required
                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                value="{{ old('date_fin') }}">
            @error('date_fin')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Type de congé -->
        <div>
            <label for="type_conge" class="block text-sm font-medium text-gray-700">Type de congé</label>
            <select id="type_conge" name="type_conge" required
                class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                <option value="annuel" {{ old('type_conge') == 'annuel' ? 'selected' : '' }}>Congé Annuel</option>
                <option value="maternite" {{ old('type_conge') == 'maternite' ? 'selected' : '' }}>Congé Maternité</option>
                <option value="parental" {{ old('type_conge') == 'parental' ? 'selected' : '' }}>Congé Parental</option>
                <option value="maladie" {{ old('type_conge') == 'maladie' ? 'selected' : '' }}>Congé Maladie</option>
            </select>
            @error('type_conge')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bouton de soumission -->
        <div class="flex justify-center mt-6">
            <button type="submit" 
                class="w-full py-2 px-4 bg-indigo-600 text-white text-lg font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Soumettre la demande
            </button>
        </div>
    </form>
</div>
@endsection
