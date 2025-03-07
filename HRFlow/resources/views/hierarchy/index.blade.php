@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-semibold text-center mb-6">Hiérarchie de l'entreprise</h1>

    <div class="flex flex-col items-center space-y-6">
        <div class="text-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Ressources Humaines (RH)</h2>
            <div class="flex justify-center space-x-3">
                @foreach ($rhes as $rh)
                    <div class="bg-blue-100 p-3 rounded-lg shadow-md text-blue-600 text-base font-medium">              
                        {{ $rh->name }}
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-1 h-6 bg-gray-400"></div>

        <div class="text-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Managers</h2>
            <div class="flex justify-center space-x-3">
                @foreach ($admins as $admin)
                    <div class="bg-green-100 p-3 rounded-lg shadow-md text-green-600 text-base font-medium">
                        {{ $admin->name }}
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-1 h-6 bg-gray-400"></div>

        <div class="text-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Responsables des Départements</h2>
            <div class="flex justify-center space-x-6">
                @foreach ($departments as $department)
                    <div class="flex flex-col items-center space-y-3">
                        <div class="bg-purple-100 p-3 rounded-lg shadow-md text-purple-600 text-base font-medium">
                            {{ $department->responsable->name ?? 'Aucun responsable' }}
                        </div>

                        <div class="w-1 h-6 bg-gray-400"></div>

                        <div class="flex justify-center space-x-3">
                            @foreach ($department->employees as $employee)
                                <div class="bg-gray-100 p-3 rounded-lg shadow-md text-gray-700 text-base">
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
