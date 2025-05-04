<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vendedor_gerente', function (Blueprint $table) {
            $table->unsignedBigInteger('vendedor');
            $table->unsignedBigInteger('gerente');

            $table->primary(['vendedor', 'gerente']);

            $table->foreign('vendedor')
                  ->references('id')
                  ->on('users')
                  ->onDelete('no action')
                  ->onUpdate('no action');

            $table->foreign('gerente')
                  ->references('id')
                  ->on('users')
                  ->onDelete('no action')
                  ->onUpdate('no action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendedor_gerente');
    }
};
