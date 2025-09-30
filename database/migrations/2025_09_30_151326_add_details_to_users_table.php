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
            // Hacemos el campo nullable para evitar el error en SQLite
            $table->string('apellido')->after('name')->nullable(); // CAMBIADO A nullable()
            
            // role tiene un default, así que está bien.
            $table->string('role')->after('password')->default('operario'); 
            
            // Hacemos el campo area nullable para evitar el error en SQLite
            $table->string('area')->after('role')->nullable(); // CAMBIADO A nullable()
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('apellido');
            $table->dropColumn('role');
            $table->dropColumn('area');
        });
    }
};
