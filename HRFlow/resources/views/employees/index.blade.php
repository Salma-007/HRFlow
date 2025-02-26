@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-2">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Liste des Employés</h1>

    @if(session('success'))
        <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('employees.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4 inline-block">Ajouter un Employé</a>

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Nom</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Rôle</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Salaire</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Type de Contrat</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Département</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Statut</th>
                <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
                <tr class="border-b">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $employee->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $employee->roles->first()->name ?? 'Aucun rôle' }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $employee->salary }} €</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $employee->contract_type }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $employee->department->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $employee->status }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        <a href="#" class="text-blue-600 hover:text-blue-800">Éditer</a> |
                        <a href="#" class="text-red-600 hover:text-red-800">Supprimer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $employees->links() }} 
    </div>
</div>
@endsection
