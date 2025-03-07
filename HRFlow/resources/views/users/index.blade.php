@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Liste des Utilisateurs</h1>
    @can('manage users')
    <div class="mb-4 text-right">
        <a href="{{ route('users.create') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Créer un Utilisateur</a>
    </div>
    @endcan
    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                    @can('manage users')
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    @endcan
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Détails</th> 
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Carrière</th>
                    @can('manage recoveries')
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jours de récupération</th> 
                    @endcan
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            @if($user->role)
                                {{ $user->role->name }}
                            @else
                                Aucun rôle
                            @endif
                        </td>
                        @can('manage users')
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Éditer</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')" class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                            </form>
                        </td>
                        @endcan
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900">Voir Détails</a> 
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('users.carrieres', $user->id) }}" class="text-blue-600 hover:text-blue-900">Carrière</a> 
                        </td>
                        @can('manage recoveries')
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="px-4 py-2 bg-green-600 text-white rounded-md" onclick="openRecoveryModal({{ $user->id }})">Ajouter Jours</button> 
                        </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>

<!-- Modal pour ajouter les jours de récupération -->
<div id="recoveryModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 hidden">
    <div class="flex justify-center items-center h-full">
        <div class="bg-white p-8 rounded-lg shadow-xl w-96">
            <h2 class="text-xl font-semibold mb-4">Ajouter Jours de Récupération</h2>
            <form id="recoveryForm" method="POST" action="{{ route('users.updateRecovery') }}">
                @csrf
                <input type="hidden" id="user_id" name="user_id" value="">
                <div class="mb-4">
                    <label for="recovery_days" class="block text-gray-700">Nombre de jours de récupération</label>
                    <input type="number" id="recovery_days" name="recovery_days" class="w-full px-4 py-2 border border-gray-300 rounded-md" min="1" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeRecoveryModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md mr-2">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openRecoveryModal(userId) {
        document.getElementById('user_id').value = userId;
        document.getElementById('recoveryModal').classList.remove('hidden');
    }

    function closeRecoveryModal() {
        document.getElementById('recoveryModal').classList.add('hidden');
    }
</script>

@endsection
