<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Executa o seeder para criar um usuário de cada papel (role).
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@barter.com',
                'password' => 'barter',
                'role_name' => 'Admin',
            ],
        ];

        foreach ($users as $userData) {
            $role = Role::where('name', $userData['role_name'])->first();

            if ($role) {
                User::firstOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name' => $userData['name'],
                        'password' => Hash::make($userData['password']),
                        'role_id' => $role->id,
                    ]
                );
            }
        }
    }
}
