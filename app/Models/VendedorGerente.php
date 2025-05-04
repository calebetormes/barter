<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo responsável por representar a relação entre vendedores e gerentes.
 * Ambos são usuários registrados na tabela 'users'.
 *
 * A tabela 'vendedor_gerente' funciona como uma tabela pivô,
 * fazendo uma relação entre usuários com funções diferentes.
 */
class VendedorGerente extends Model
{
    /**
     * O Laravel por padrão espera uma coluna 'id' como chave primária.
     * Como esta tabela possui uma chave primária composta (vendedor, gerente),
     * desativamos o uso do campo 'id'.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indica que as chaves primárias não são do tipo integer simples.
     * Aqui usamos BIGINT UNSIGNED.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indica que essa tabela não possui os campos 'created_at' e 'updated_at'.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Nome da tabela no banco de dados explicitamente definido.
     *
     * @var string
     */
    protected $table = 'vendedor_gerente';

    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vendedor', // ID do usuário com papel de vendedor
        'gerente',  // ID do usuário com papel de gerente
    ];

    /**
     * Relacionamento: este registro pertence a um usuário com papel de vendedor.
     *
     * @return BelongsTo
     */
    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendedor');
    }

    /**
     * Relacionamento: este registro pertence a um usuário com papel de gerente.
     *
     * @return BelongsTo
     */
    public function gerente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'gerente');
    }
}
