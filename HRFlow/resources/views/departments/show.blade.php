@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Détails du Département</h1>

    <div>
        <strong>Nom :</strong> {{ $department->name }}
    </div>
    <div>
        <strong>Description :</strong> {{ $department->description }}
    </div>

    <a href="{{ route('departments.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 mt-4 inline-block">Retour à la liste</a>
</div>
@endsection
