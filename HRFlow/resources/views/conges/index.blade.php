@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-semibold mb-6 text-center">Liste des Congés</h1>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">#</th>
                    <th class="py-3 px-6 text-left">Utilisateur</th>
                    <th class="py-3 px-6 text-left">Date de début</th>
                    <th class="py-3 px-6 text-left">Date de fin</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($conges as $conge)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-6 text-left">{{ $conge->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $conge->user->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $conge->date_debut }}</td>
                        <td class="py-3 px-6 text-left">{{ $conge->date_fin }}</td>
                        <td class="py-3 px-6 text-left">
                            <span class="text-sm py-1 px-2 rounded-full 
                                @if($conge->status == 'pending') bg-yellow-300 text-yellow-800
                                @elseif($conge->status == 'refused') bg-red-300 text-red-800
                                @elseif($conge->status == 'accepted') bg-green-300 text-green-800
                                @endif">
                                {{ ucfirst($conge->status) }}
                            </span>
                        </td>
                        @if($conge->status == 'pending')
                        <td class="py-3 px-6 text-left flex space-x-2">
                            <!-- Formulaire pour accepter -->
                            <form action="" method="POST" class="inline-block">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300"
                                        name="status" value="accepted">Accepter</button>
                            </form>

                            <!-- Formulaire pour refuser -->
                            <form action="" method="POST" class="inline-block">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300"
                                        name="status" value="refused">Refuser</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6">
        {{ $conges->links() }}
    </div>
    </div>
</div>
@endsection
