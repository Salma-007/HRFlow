@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Créer un Département</h1>

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-600">Nom</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
            <textarea name="description" id="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md"></textarea>
        </div>

        <div class="mb-4">
            <label for="responsable_id" class="block text-sm font-medium text-gray-600">Responsable</label>
            <select name="responsable_id" id="responsable_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                <option value="">Sélectionner un responsable</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Créer</button>
    </form>
</div>
@endsection
