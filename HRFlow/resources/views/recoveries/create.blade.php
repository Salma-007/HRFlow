@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-center mb-6 text-gray-800">Faire une Demande de Récupération</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <form action="{{ route('recoveries.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="date_debut" class="block text-lg font-medium text-gray-700">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" class="w-full p-3 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="date_fin" class="block text-lg font-medium text-gray-700">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" class="w-full p-3 mt-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">Soumettre la Demande</button>
        </form>
    </div>
</div>
@endsection
