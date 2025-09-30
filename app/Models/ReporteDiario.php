<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteDiario extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     * Esto permite asignar todos los campos excepto el ID y timestamps.
     */
    protected $fillable = [
        'empresa_id',
        'planta_id',
        'fecha',
        'tonelaje_procesado',
        'ley_mineral',
        'estado',
        'aprobado_por_user_id',
        'fecha_aprobacion',
    ];

    /**
     * Definir las relaciones (Foreign Keys).
     */

    // Relación al Aislamiento SaaS
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    // Relación al Aislamiento por Área
    public function planta()
    {
        return $this->belongsTo(Planta::class);
    }

    // Relación al usuario que creó o modificó
    public function usuarioCreador()
    {
        // Asumimos que quieres relacionar el reporte al usuario que lo crea.
        // Si no tienes un campo 'user_id' explícito, puedes usar las convenciones de Laravel
        // o añadirlo después. Por ahora, nos enfocamos en el aprobador.
        return $this->belongsTo(User::class, 'created_by_user_id'); // Si añades created_by_user_id después
    }

    // Relación al usuario que aprobó el reporte (Supervisor/Gerente)
    public function aprobador()
    {
        return $this->belongsTo(User::class, 'aprobado_por_user_id');
    }
}