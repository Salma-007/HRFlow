@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Liste des Départements</h1>
    @can('gestion des departements')
    <a href="{{ route('departments.create') }}" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300 ease-in-out shadow-md">Créer un département</a>
    @endcan
    @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-6 py-3 text-left text-sm font-medium">Nom</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Description</th>
                    <th class="px-6 py-3 text-left text-sm font-medium">Responsable</th>
                    @can('gestion des departements')
                    <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                    <tr class="hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">{{ $department->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">{{ $department->description }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700 border-b">
                            {{ $department->responsable ? $department->responsable->name : 'Aucun responsable' }}
                        </td>
                        @can('gestion des departements')
                        <td class="px-6 py-4 text-sm text-gray-700 border-b flex items-center space-x-2">
                            <a href="{{ route('departments.edit', $department->id) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition duration-300 ease-in-out">Modifier</a>
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-300 ease-in-out">Supprimer</button>
                            </form>
                        </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $departments->links() }}
    </div>
</div>
@endsection
