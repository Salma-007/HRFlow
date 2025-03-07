@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-center mb-6 text-gray-800">Demandes de Récupération</h1>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-6">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="text-left text-lg text-gray-600">
                    <th class="px-4 py-2">Nom de l'Employé</th>
                    <th class="px-4 py-2">Date Début</th>
                    <th class="px-4 py-2">Date Fin</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recoveries as $recovery)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $recovery->user->name }}</td>
                        <td class="px-4 py-2">{{ $recovery->date_debut }}</td>
                        <td class="px-4 py-2">{{ $recovery->date_fin }}</td>
                        <td class="px-4 py-2">
                            <span class="px-4 py-2 text-sm {{ $recovery->status == 'accepted' ? 'bg-green-500' : ($recovery->status == 'refused' ? 'bg-red-500' : 'bg-yellow-500') }} text-white rounded-full">
                                {{ ucfirst($recovery->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2">
                            @if ($recovery->status == 'pending' && Auth::user()->role_id == 2)
                                <div class="flex space-x-2">
                                    <form action="{{ route('recoveries.approveByRh', $recovery->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Approuver</button>
                                    </form>
                                    <form action="{{ route('recoveries.rejectByRh', $recovery->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Refuser</button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $recoveries->links() }}
        </div>
    </div>
</div>
@endsection
