<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo responsável por representar os papéis (funções) dos usuários.
 * Esta classe está vinculada à tabela 'roles' no banco de dados.
 */
class Role extends Model
{
    // Trait que permite o uso de factories para testes e seeders
    use HasFactory;

    /**
     * Atributos que podem ser atribuídos em massa (mass assignment).
     *
     * Esses campos podem ser preenchidos automaticamente usando métodos como create() ou update().
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Nome do papel, como 'admin', 'editor', 'usuário comum', etc.
    ];

    /**
     * Indica se a tabela possui timestamps (created_at e updated_at).
     *
     * Como a tabela `roles` não possui esses campos, desativamos aqui.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Define o relacionamento com o modelo User.
     *
     * Um papel pode estar relacionado a vários usuários.
     *
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'roles_id');
    }
}
