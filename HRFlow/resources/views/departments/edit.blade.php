@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Modifier le Département</h1>

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-600">Nom</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('name', $department->name) }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">{{ old('description', $department->description) }}</textarea>
        </div>

        <!-- Champ pour sélectionner le responsable -->
        <div class="mb-4">
            <label for="responsable_id" class="block text-sm font-medium text-gray-600">Responsable</label>
            <select name="responsable_id" id="responsable_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                <option value="" @if(is_null($department->responsable)) selected @endif>Aucun responsable</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @if($department->responsable_id == $user->id) selected @endif>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Mettre à jour</button>
    </form>
</div>
@endsection
