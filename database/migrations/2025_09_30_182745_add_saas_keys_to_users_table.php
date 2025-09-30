<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Vincula a la Empresa (Aislamiento de Clientes, clave para SaaS)
            $table->foreignId('empresa_id')
                  ->nullable()
                  ->constrained('empresas')
                  ->onDelete('cascade')
                  ->after('email');

            // 2. Vincula a la Planta (Aislamiento de Áreas/Roles)
            $table->foreignId('planta_id')
                  ->nullable()
                  ->constrained('plantas')
                  ->onDelete('set null')
                  ->after('empresa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Debemos eliminar las claves foráneas y luego las columnas
            $table->dropForeign(['planta_id']);
            $table->dropForeign(['empresa_id']);
            $table->dropColumn(['planta_id', 'empresa_id']);
        });
    }
};
