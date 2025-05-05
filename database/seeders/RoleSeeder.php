<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Executa o seeder para inserir os papéis (roles) na tabela.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Gerente Nacional'],
            ['name' => 'Gerente Comercial'],
            ['name' => 'Vendedor'],
        ];

        foreach ($roles as $role) {
            // Cria o papel se ainda não existir
            Role::firstOrCreate(['name' => $role['name']]);
        }
    }
}
