@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Liste des Départements</h1>

    <a href="{{ route('departments.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Créer un département</a>

    @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6">
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Nom</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($departments as $department)
                    <tr>
                        <td class="px-4 py-2">{{ $department->name }}</td>
                        <td class="px-4 py-2">{{ $department->description }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('departments.edit', $department->id) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">Modifier</a>
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
