<!-- resources/views/formations/users.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">Concernés de la formation "{{ $formation->name }}"</h1>

    <a href="{{ route('formations.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 mb-4 inline-block">Retour à la liste des formations</a>

    <div class="mt-6">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left bg-gray-100">Nom</th>
                    <th class="px-4 py-2 text-left bg-gray-100">Email</th>
                    <th class="px-4 py-2 text-left bg-gray-100">Date d'inscription</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
