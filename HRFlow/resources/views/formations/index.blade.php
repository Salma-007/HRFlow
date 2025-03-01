@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Liste des Formations</h1>

    <a href="{{ route('formations.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 mb-4 inline-block">Créer une Formation</a>

    @if(session('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left bg-gray-100">Nom</th>
                    <th class="px-4 py-2 text-left bg-gray-100">Type</th>
                    <th class="px-4 py-2 text-left bg-gray-100">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formations as $formation)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $formation->name }}</td>
                        <td class="px-4 py-2">{{ ucfirst($formation->type) }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('formations.edit', $formation->id) }}" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">Modifier</a>
                            <form action="{{ route('formations.destroy', $formation->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Supprimer</button>
                            </form>
                            <a href="{{ route('formations.users', $formation->id) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Voir users</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $formations->links() }}
    </div>
</div>
@endsection
