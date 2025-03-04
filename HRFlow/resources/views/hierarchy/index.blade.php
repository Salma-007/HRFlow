@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-semibold text-center mb-8">Hiérarchie de l'entreprise</h1>

    <!-- Organigramme -->
    <div class="flex flex-col items-center space-y-8">
        <!-- Niveau Admin -->
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Admin</h2>
            <div class="flex justify-center space-x-4">
                @foreach ($admins as $admin)
                    <div class="bg-blue-100 p-4 rounded-lg shadow-md text-blue-600 text-lg font-medium">
                        {{ $admin->name }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Flèche vers le bas -->
        <div class="w-1 h-8 bg-gray-400"></div>

        <!-- Niveau RH -->
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Ressources Humaines (RH)</h2>
            <div class="flex justify-center space-x-4">
                @foreach ($rhes as $rh)
                    <div class="bg-green-100 p-4 rounded-lg shadow-md text-green-600 text-lg font-medium">
                        {{ $rh->name }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Flèche vers le bas -->
        <div class="w-1 h-8 bg-gray-400"></div>

        <!-- Niveau Départements -->
        <div class="text-center">
            <h2 class="text-3xl font-semibold text-gray-800 mb-4">Départements</h2>
            <div class="flex justify-center space-x-8">
                @foreach ($departments as $department)
                    <div class="flex flex-col items-center space-y-4">
                        <!-- Responsable du Département -->
                        <div class="bg-purple-100 p-4 rounded-lg shadow-md text-purple-600 text-lg font-medium">
                            {{ $department->responsable->name ?? 'Aucun responsable' }}
                        </div>

                        <!-- Flèche vers le bas -->
                        <div class="w-1 h-8 bg-gray-400"></div>

                        <!-- Employés du Département -->
                        <div class="flex justify-center space-x-4">
                            @foreach ($department->employees as $employee)
                                <div class="bg-gray-100 p-4 rounded-lg shadow-md text-gray-700 text-lg">
                                    {{ $employee->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection