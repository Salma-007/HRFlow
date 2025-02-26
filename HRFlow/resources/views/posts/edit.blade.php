@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Modifier le Post</h1>
    
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" id="name" name="name" value="{{ old('name', $post->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div class="mb-4">
        <label for="departments_id" class="block text-sm font-medium text-gray-700">Département</label>
        <select id="departments_id" name="departments_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ $department->id == old('departments_id', $post->departments_id) ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Mettre à jour</button>
    </div>
</form>

</div>
@endsection
