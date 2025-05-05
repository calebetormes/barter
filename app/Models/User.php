<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // renomeado de roles_id para seguir padrão Laravel/Filament
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relacionamento com o papel (role) do usuário.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Vendedores supervisionados por este gerente.
     */
    public function vendedores(): HasMany
    {
        return $this->hasMany(VendedorGerente::class, 'gerente');
    }

    /**
     * Gerentes associados a este vendedor.
     */
    public function gerentes(): HasMany
    {
        return $this->hasMany(VendedorGerente::class, 'vendedor');
    }

    /**
     * Verifica se o usuário possui o papel informado.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }

    /**
     * Verifica se é administrador.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
