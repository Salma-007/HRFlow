@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        @can('voir statistics')
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-3xl font-bold">{{ __("Welcome to your dashboard!") }}</h2>
                <p class="text-lg mt-2 text-gray-600 dark:text-gray-400">{{ __("Here are some important statistics.") }}</p>
            </div>
        @endcan
            <!-- Statistiques -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 p-6">
                <!-- Carte HR -->
                @can('voir statistics')
                <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 duration-300 ease-in-out">
                    <div class="flex items-center justify-between">
                        <div class="text-3xl font-semibold">{{ $totalHR }}</div>
                        <div class="text-4xl">
                            <i class="fas fa-users-cog"></i> 
                        </div>
                    </div>
                    <h3 class="text-xl mt-4 font-semibold">Total HR</h3>
                </div>

                <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 duration-300 ease-in-out">
                    <div class="flex items-center justify-between">
                        <div class="text-3xl font-semibold">{{ $totalEmployees }}</div>
                        <div class="text-4xl">
                            <i class="fas fa-users"></i> 
                        </div>
                    </div>
                    <h3 class="text-xl mt-4 font-semibold">Total Employees</h3>
                </div>

                <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 duration-300 ease-in-out">
                    <div class="flex items-center justify-between">
                        <div class="text-3xl font-semibold">{{ $totalManagers }}</div>
                        <div class="text-4xl">
                            <i class="fas fa-briefcase"></i> 
                        </div>
                    </div>
                    <h3 class="text-xl mt-4 font-semibold">Total Managers</h3>
                </div>

                <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 duration-300 ease-in-out">
                    <div class="flex items-center justify-between">
                        <div class="text-3xl font-semibold">{{ $totalFormations }}</div>
                        <div class="text-4xl">
                            <i class="fas fa-chalkboard-teacher"></i> 
                        </div>
                    </div>
                    <h3 class="text-xl mt-4 font-semibold">Total Formations</h3>
                </div>
                @endcan
                @can('voir mes conges')
                <!-- Carte Congés -->
                <div class="bg-indigo-500 text-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 duration-300 ease-in-out">
                    <div class="flex items-center justify-between">
                        <div class="text-3xl font-semibold">{{ number_format($leaveDays, 1) }}</div>
                        <div class="text-4xl">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                </div>
                    <h3 class="text-xl mt-4 font-semibold">Jours de Congé Restants</h3>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
