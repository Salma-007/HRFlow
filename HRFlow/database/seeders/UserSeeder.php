<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);

        $user = User::create([
            'name' => 'Admin User',
            'email' => 'salma@gmail.com',
            'password' => Hash::make('password123'), 
        ]);

        $user->assignRole($role);
    }
}
