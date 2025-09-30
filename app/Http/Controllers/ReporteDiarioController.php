<?php

namespace App\Http\Controllers;

use App\Models\ReporteDiario; // Importar el modelo
use Illuminate\Http\Request;

class ReporteDiarioController extends Controller
{
    /**
     * Display a listing of the resource.
     * IMPLEMENTACIÓN CLAVE: Aislamiento por Planta y Permiso Gerencial.
     */
    public function index()
    {
        // 1. Obtener el usuario autenticado y su planta asignada
        $user = auth()->user();
        $reportesQuery = ReporteDiario::query();

        // 2. Control de Permisos (RBAC - review_all_reportes)
        // El Gerente General o Administrador puede ver todos los reportes, sin importar la Planta.
        if (!$user->can('review_all_reportes')) {
            // Si el usuario NO tiene permiso para ver TODO, aplicamos el aislamiento:
            // Solo puede ver los reportes que coincidan con su planta_id.
            $reportesQuery->where('planta_id', $user->planta_id);
        }

        // 3. Obtener y retornar los reportes
        $reportes = $reportesQuery->orderBy('fecha', 'desc')->paginate(10);

        // NOTA: La vista 'reportes.index' aún no existe, la crearemos después.
        return view('reportes.index', compact('reportes')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Aplicar permiso RBAC: Solo 'operario' o roles superiores pueden crear.
        $this->authorize('report_diario'); 

        return view('reportes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lógica de validación, creación y asignación automática de empresa_id y planta_id.
        // La implementaremos a detalle en el siguiente paso.
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Lógica para mostrar un reporte específico
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Lógica de edición
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lógica de actualización
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Lógica de eliminación
    }
}