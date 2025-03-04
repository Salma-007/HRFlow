@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Modifier l'Utilisateur</h1>
    @if ($errors->any())
        <div class="alert alert-danger text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="role_id" class="block text-sm font-medium text-gray-700">Rôle</label>
                <select id="role_id" name="role_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Salaire</label>
                <input type="text" id="salary" name="salary" value="{{ old('salary', $user->salary) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="birthdate" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="hire_date" class="block text-sm font-medium text-gray-700">Date d'embauche</label>
                <input type="date" id="hire_date" name="hire_date" value="{{ old('hire_date', $user->hire_date) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Actif</option>
                <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Mettre à jour</button>
        </div>
    </form>
</div>
@endsection
