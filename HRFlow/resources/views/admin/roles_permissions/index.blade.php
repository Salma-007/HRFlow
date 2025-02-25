@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-2">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Gestion des Rôles et Permissions</h1>

    <!-- Afficher les messages de succès -->
    @if(session('success'))
        <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire pour créer un rôle -->
    <div class="mb-8">
        <h3 class="text-xl font-medium text-gray-700 mb-4">Créer un rôle</h3>
        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="roleName" class="block text-sm font-medium text-gray-600">Nom du rôle</label>
                <input type="text" name="name" id="roleName" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <!-- Sélectionner des permissions -->
            <div class="mb-4">
                <label for="permissions" class="block text-sm font-medium text-gray-600">Sélectionner des permissions</label>
                <select name="permissions[]" id="permissions" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" multiple>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Créer le rôle
            </button>
        </form>
    </div>

    <hr class="my-6 border-t border-gray-200">

    <!-- Formulaire pour créer une permission -->
    <div class="mb-8">
        <h3 class="text-xl font-medium text-gray-700 mb-4">Créer une permission</h3>
        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="permissionName" class="block text-sm font-medium text-gray-600">Nom de la permission</label>
                <input type="text" name="name" id="permissionName" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
            </div>

            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                Créer la permission
            </button>
        </form>
    </div>

    <hr class="my-6 border-t border-gray-200">

    <!-- Liste des rôles existants avec pagination -->
    <div class="mb-8">
        <h3 class="text-xl font-medium text-gray-700 mb-4">Rôles existants</h3>
        <ul class="space-y-2">
            @foreach($roles as $role)
                <li class="px-4 py-2 bg-gray-50 text-gray-800 rounded-lg shadow-sm hover:bg-gray-100 flex justify-between items-center">
                    {{ $role->name }}
                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Supprimer
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
        <!-- Lien de pagination -->
        <div class="mt-4">
            {{ $roles->links() }}
        </div>
    </div>

    <hr class="my-6 border-t border-gray-200">

    <!-- Liste des permissions existantes avec pagination -->
    <div>
        <h3 class="text-xl font-medium text-gray-700 mb-4">Permissions existantes</h3>
        <ul class="space-y-2">
            @foreach($permissions as $permission)
                <li class="px-4 py-2 bg-gray-50 text-gray-800 rounded-lg shadow-sm hover:bg-gray-100 flex justify-between items-center">
                    {{ $permission->name }}
                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette permission ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Supprimer
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
        <!-- Lien de pagination -->
        <div class="mt-4">
            {{ $permissions->links() }}
        </div>
    </div>
</div>
@endsection
