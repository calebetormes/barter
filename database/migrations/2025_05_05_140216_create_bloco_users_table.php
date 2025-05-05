<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabela de níveis de acesso
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT
            $table->string('name', 245)->nullable();
        });

        // Tabela de usuários
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreignId('role_id')
                  ->constrained('roles')
                  ->onUpdate('no action')
                  ->onDelete('no action');
        });

        // Tabela de relacionamento vendedor-gerente
        Schema::create('gerente_vendedor', function (Blueprint $table) {
            $table->unsignedBigInteger('vendedor');
            $table->unsignedBigInteger('gerente');

            $table->primary(['Gerente', 'Vendedor']);

            $table->foreign('vendedor')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();

            $table->foreign('gerente')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });

        // Tabela padrão de resets
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabela de sessões
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('vendedor_gerente');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
};

