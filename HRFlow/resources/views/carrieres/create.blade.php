@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Ajouter une nouvelle carrière pour {{ $user->name }}</h1>

    <a href="{{ route('users.carrieres', $user->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 mb-4 inline-block">Retour à l'historique</a>

    <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('carrieres.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Grade -->
                <div>
                    <label for="grade_id" class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
                    <select id="grade_id" name="grade_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <option value="">Sélectionner un grade</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id', $user->grade_id) == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Formation -->
                <div>
                    <label for="formation_id" class="block text-sm font-medium text-gray-700 mb-1">Formation</label>
                    <select id="formation_id" name="formation_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Aucune formation</option>
                        @foreach($formations as $formation)
                            <option value="{{ $formation->id }}" {{ old('formation_id') == $formation->id ? 'selected' : '' }}>{{ $formation->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Contrat -->
                <div>
                    <label for="contract_id" class="block text-sm font-medium text-gray-700 mb-1">Contrat</label>
                    <select id="contract_id" name="contract_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <option value="">Sélectionner un contrat</option>
                        @foreach($contracts as $contract)
                            <option value="{{ $contract->id }}" {{ old('contract_id', $user->contract_id) == $contract->id ? 'selected' : '' }}>{{ $contract->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Département -->
                <div>
                    <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1">Département</label>
                    <select id="department_id" name="department_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <option value="">Sélectionner un département</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Poste -->
                <div>
                    <label for="post_id" class="block text-sm font-medium text-gray-700 mb-1">Poste</label>
                    <select id="post_id" name="post_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                        <option value="">Sélectionner un poste</option>
                        @foreach($posts as $post)
                            <option value="{{ $post->id }}" {{ old('post_id', $user->post_id) == $post->id ? 'selected' : '' }}>{{ $post->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date de début -->
                <div>
                    <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" value="{{ old('date_debut', date('Y-m-d')) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                </div>

                <!-- Date de fin -->
                <div>
                    <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">Date de fin (laisser vide si en cours)</label>
                    <input type="date" id="date_fin" name="date_fin" value="{{ old('date_fin') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                </div>

                <!-- Commentaire -->
                <div class="md:col-span-2">
                    <label for="commentaire" class="block text-sm font-medium text-gray-700 mb-1">Commentaire</label>
                    <textarea id="commentaire" name="commentaire" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('commentaire') }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Ajouter la carrière</button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const departmentSelect = document.getElementById('department_id');
        const postSelect = document.getElementById('post_id');
        
        function updatePosts() {
            const departmentId = departmentSelect.value;
            
            if (departmentId) {
                postSelect.disabled = true;
                
                fetch(`/posts-by-department/${departmentId}`)
                    .then(response => response.json())
                    .then(data => {

                        postSelect.innerHTML = '<option value="">Sélectionner un poste</option>';

                        data.forEach(post => {
                            const option = document.createElement('option');
                            option.value = post.id;
                            option.textContent = post.name;
                            postSelect.appendChild(option);
                        });
                        
                        postSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des postes:', error);
                        postSelect.disabled = false;
                    });
            } else {
                postSelect.innerHTML = '<option value="">Sélectionner un poste</option>';
            }
        }
        
        departmentSelect.addEventListener('change', updatePosts);
        
        if (departmentSelect.value) {
            updatePosts();
        }
    });
</script>
@endsection

@endsection