<?php

namespace App\Http\Controllers;

use App\Models\ReporteDiario; // Importar el modelo
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // <-- ¡Añadido! Necesario para la validación única

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
        if (!$user->can('review_all_reportes')) {
            // Aplicamos el aislamiento: Solo puede ver los reportes de su planta_id.
            $reportesQuery->where('planta_id', $user->planta_id);
        }

        // 3. Obtener y retornar los reportes
        $reportes = $reportesQuery->orderBy('fecha', 'desc')->paginate(10);

        return view('reportes.index', compact('reportes')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Aplicar permiso RBAC: Solo roles que pueden 'report_diario' pueden crear.
        $this->authorize('report_diario'); 

        return view('reportes.create');
    }

    /**
     * Store a newly created resource in storage.
     * IMPLEMENTACIÓN CLAVE: Validación, RBAC y Aislamiento SaaS.
     */
    public function store(Request $request)
    {
        // 1. Aplicar Permiso RBAC: Solo roles que pueden 'report_diario'
        $this->authorize('report_diario');

        // 2. Obtener el usuario autenticado (necesario para el aislamiento)
        $user = auth()->user();

        // 3. Validación de Datos
        $validated = $request->validate([
            // Única SOLO para la combinación de Empresa/Planta (Evita reportes duplicados)
            'fecha' => [
                'required', 
                'date', 
                'before_or_equal:today', 
                Rule::unique('reporte_diarios')->where(function ($query) use ($user) {
                    return $query->where('planta_id', $user->planta_id);
                })
            ],
            'tonelaje_procesado' => 'required|numeric|min:0',
            'ley_mineral' => 'required|numeric|min:0',
        ]);

        // 4. Creación del Reporte con Aislamiento (El CORE del SaaS)
        ReporteDiario::create([
            'empresa_id' => $user->empresa_id, // Asignación automática por Usuario
            'planta_id' => $user->planta_id,   // Asignación automática por Usuario
            'fecha' => $validated['fecha'],
            'tonelaje_procesado' => $validated['tonelaje_procesado'],
            'ley_mineral' => $validated['ley_mineral'],
            'estado' => 'PENDIENTE', // Siempre inicia Pendiente
        ]);

        return redirect()->route('reportes.index')
                         ->with('success', 'Reporte diario creado y enviado para aprobación.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}