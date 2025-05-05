<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabelas auxiliares
        Schema::create('produtos_classes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            //$table->timestamps();
        });

        Schema::create('principios_ativos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            //$table->timestamps();
        });

        Schema::create('marcas_comerciais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            //$table->timestamps();
        });

        Schema::create('tipos_de_peso', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_peso');
            //$table->timestamps();
        });

        Schema::create('familia', function (Blueprint $table) {
            $table->id();
            $table->string('familia');
            //$table->timestamps();
        });

        // Tabela principal: produtos
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('classe')->constrained('produtos_classes')->cascadeOnDelete();
            $table->foreignId('principios_ativo')->constrained('principios_ativos')->cascadeOnDelete();
            $table->foreignId('marca_comercial')->constrained('marcas_comerciais')->cascadeOnDelete();
            $table->foreignId('tipos_de_peso')->constrained('tipos_de_peso')->cascadeOnDelete();
            $table->foreignId('familia')->constrained('familia')->cascadeOnDelete();

            $table->string('apresentacao')->nullable();
            $table->string('dose_sugerida_hectare')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Ordem reversa para evitar erros
        Schema::dropIfExists('produtos');
        Schema::dropIfExists('familia');
        Schema::dropIfExists('tipos_de_peso');
        Schema::dropIfExists('marcas_comerciais');
        Schema::dropIfExists('principios_ativos');
        Schema::dropIfExists('produtos_classes');
    }
};
