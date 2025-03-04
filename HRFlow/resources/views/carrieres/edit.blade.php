@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Modifier la carrière de {{ $carriere->user->name }}</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('carrieres.update', $carriere->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Informations générales</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="date_debut" class="text-sm text-gray-600">Date de début</label>
                        <input type="date" name="date_debut" id="date_debut" value="{{ $carriere->date_debut->format('Y-m-d') }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label for="date_fin" class="text-sm text-gray-600">Date de fin</label>
                        <input type="date" name="date_fin" id="date_fin" value="{{ $carriere->date_fin ? $carriere->date_fin->format('Y-m-d') : '' }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Détails du poste</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="grade_id" class="text-sm text-gray-600">Grade</label>
                        <select name="grade_id" id="grade_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}" {{ $carriere->grade_id == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="post_id" class="text-sm text-gray-600">Poste</label>
                        <select name="post_id" id="post_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                            @foreach($posts as $post)
                                <option value="{{ $post->id }}" {{ $carriere->post_id == $post->id ? 'selected' : '' }}>
                                    {{ $post->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="contract_id" class="text-sm text-gray-600">Contrat</label>
                        <select name="contract_id" id="contract_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                            @foreach($contracts as $contract)
                                <option value="{{ $contract->id }}" {{ $carriere->contract_id == $contract->id ? 'selected' : '' }}>
                                    {{ $contract->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="formation_id" class="text-sm text-gray-600">Formation</label>
                        <select name="formation_id" id="formation_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                            <option value="">Aucune</option>
                            @foreach($formations as $formation)
                                <option value="{{ $formation->id }}" {{ $carriere->formation_id == $formation->id ? 'selected' : '' }}>
                                    {{ $formation->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="department_id" class="text-sm text-gray-600">Département</label>
                        <select name="department_id" id="department_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $carriere->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">Commentaire</h2>
                <textarea name="commentaire" id="commentaire" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">{{ $carriere->commentaire }}</textarea>
            </div>

            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Sauvegarder les modifications
            </button>
        </form>
    </div>
</div>
@endsection
