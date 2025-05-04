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
            ['name' => 'Vendedor'],
            ['name' => 'Gerente Comercial'],
            ['name' => 'Gerente Nacional'],
            ['name' => 'Administrador de Vendas'],
        ];

        foreach ($roles as $role) {
            // Cria o papel se ainda não existir
            Role::firstOrCreate(['name' => $role['name']]);
        }
    }
}
