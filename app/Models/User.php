<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Modelo responsável por representar os usuários do sistema.
 * Este modelo é mapeado diretamente com a tabela 'users' no banco de dados.
 */
class User extends Authenticatable
{

    // Trait que permite o uso de factories para testes e seeders
    use HasFactory;

    /**
     * Atributos que podem ser atribuídos em massa (mass assignment).
     *
     * Esses são os campos que podem ser preenchidos via métodos como create() e update().
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',          // Nome do usuário
        'email',         // E-mail do usuário
        'password',      // Senha (armazenada de forma segura)
        'roles_id',      // Chave estrangeira para a tabela de papéis (roles)
    ];

    /**
     * Atributos que devem ser ocultados na serialização do modelo.
     *
     * Esses campos não aparecem quando o modelo é convertido para array ou JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // Nunca exibir a senha
        'remember_token',   // Token de sessão utilizado para "lembrar de mim"
    ];

    /**
     * Conversão automática de tipos de atributos.
     *
     * Define como os campos serão convertidos automaticamente ao serem acessados.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', // Converte para objeto Carbon (data/hora)
        'password' => 'hashed',            // Garante que o campo 'password' seja sempre hasheado
        'created_at' => 'datetime',        // Conversão automática para data/hora
        'updated_at' => 'datetime',
    ];

    /**
     * Define o relacionamento deste usuário com a tabela de papéis (roles).
     *
     * Cada usuário pertence a um único papel.
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roles_id');
    }

    /**
     * Vendedores que este gerente supervisiona.
     */
    public function vendedores()
    {
        return $this->hasMany(VendedorGerente::class, 'gerente');
    }

    /**
     * Gerentes aos quais este vendedor está vinculado.
     */
    public function gerentes()
    {
        return $this->hasMany(VendedorGerente::class, 'vendedor');
    }
}
