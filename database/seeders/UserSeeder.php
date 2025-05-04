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
                'name' => 'Usuário Vendedor',
                'email' => 'vendedor@barter.com',
                'password' => 'barter',
                'role_name' => 'Vendedor',
            ],
            [
                'name' => 'Usuário Gerente Comercial',
                'email' => 'gerente.comercial@barter.com',
                'password' => 'barter',
                'role_name' => 'Gerente Comercial',
            ],
            [
                'name' => 'Usuário Gerente Nacional',
                'email' => 'gerente.nacional@barter.com',
                'password' => 'barter',
                'role_name' => 'Gerente Nacional',
            ],
            [
                'name' => 'Administrador de Vendas',
                'email' => 'admin.vendas@barter.com',
                'password' => 'barter',
                'role_name' => 'Administrador de Vendas',
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
                        'roles_id' => $role->id,
                    ]
                );
            }
        }
    }
}
