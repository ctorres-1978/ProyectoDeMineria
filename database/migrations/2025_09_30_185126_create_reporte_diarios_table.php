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
        Schema::create('reporte_diarios', function (Blueprint $table) {
            $table->id();
            
            // 1. CLAVES DE AISLAMIENTO (SaaS)
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->foreignId('planta_id')->constrained('plantas')->onDelete('cascade');
            
            // 2. DATOS DEL REPORTE
            $table->date('fecha')->unique(); // La fecha es única por reporte
            $table->decimal('tonelaje_procesado', 10, 2);
            $table->decimal('ley_mineral', 8, 4); // Ley del mineral (ej. 0.8540%)
            
            // 3. ESTADO Y CONTROL
            // Estado: PENDIENTE, APROBADO, RECHAZADO
            $table->string('estado')->default('PENDIENTE'); 
            
            // Usuario que aprobó el reporte (Supervisor/Gerente)
            $table->foreignId('aprobado_por_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('fecha_aprobacion')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_diarios');
    }
};