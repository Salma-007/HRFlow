@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Modifier la Formation</h1>

    <form action="{{ route('formations.update', $formation->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-600">Nom</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $formation->name }}" required>
        </div>

        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-600">Type</label>
            <select name="type" id="type" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                <option value="presentiel" {{ $formation->type == 'presentiel' ? 'selected' : '' }}>Présentiel</option>
                <option value="en ligne" {{ $formation->type == 'en ligne' ? 'selected' : '' }}>En ligne</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="users" class="block text-sm font-medium text-gray-600">Associer des utilisateurs</label>
            <select name="users[]" id="users" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" multiple>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Mettre à jour la Formation</button>
    </form>
</div>
@endsection
