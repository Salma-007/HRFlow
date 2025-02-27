@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Créer un Utilisateur</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Rôle -->
            <div class="mb-4">
                <label for="role_id" class="block text-sm font-medium text-gray-700">Rôle</label>
                <select id="role_id" name="role_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Département -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="department_id" class="block text-sm font-medium text-gray-700">Département</label>
                <select id="department_id" name="department_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Sélectionnez un département</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Poste -->
            <div class="mb-4">
                <label for="post_id" class="block text-sm font-medium text-gray-700">Poste</label>
                <select id="post_id" name="post_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Sélectionnez un poste</option>
                    <!-- Les postes seront chargés dynamiquement ici -->
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Grade -->
        <div class="mb-4">
            <label for="grade_id" class="block text-sm font-medium text-gray-700">Grade</label>
            <select id="grade_id" name="grade_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Sélectionnez un grade</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Contract -->
        <div class="mb-4">
            <label for="contract_id" class="block text-sm font-medium text-gray-700">Contrat</label>
            <select id="contract_id" name="contract_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Sélectionnez un contrat</option>
                @foreach($contracts as $contract)
                    <option value="{{ $contract->id }}" {{ old('contract_id') == $contract->id ? 'selected' : '' }}>{{ $contract->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="salary" class="block text-sm font-medium text-gray-700">Salaire</label>
                <input type="text" id="salary" name="salary" value="{{ old('salary') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="birthdate" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                <input type="date" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
            <input type="text" id="address" name="address" value="{{ old('address') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="mb-4">
                <label for="hire_date" class="block text-sm font-medium text-gray-700">Date d'embauche</label>
                <input type="date" id="hire_date" name="hire_date" value="{{ old('hire_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Actif</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Créer</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const departmentSelect = document.getElementById('department_id');
        const postSelect = document.getElementById('post_id');

        departmentSelect.addEventListener('change', function () {
            const departmentId = departmentSelect.value;

            if (departmentId) {
                fetch(`/get-posts/${departmentId}`)
                    .then(response => response.json())
                    .then(data => {
                        postSelect.innerHTML = '<option value="">Sélectionnez un poste</option>';
                        
                        data.forEach(post => {
                            const option = document.createElement('option');
                            option.value = post.id;
                            option.textContent = post.name;
                            postSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                    });
            } else {
                postSelect.innerHTML = '<option value="">Sélectionnez un poste</option>';
            }
        });
    });
</script>
@endsection
