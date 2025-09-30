<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;
use App\Models\Planta;

class EmpresaPlantaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear la Empresa Raíz (ID 1)
        $empresa = Empresa::create([
            'nombre' => 'Minera Austral S.A.',
            'rut' => '76.123.456-7',
        ]);

        // 2. Crear las Plantas para Minera Austral S.A.
        // Los IDs de Planta serán del 1 en adelante, necesarios para los usuarios de prueba.
        Planta::create([
            'empresa_id' => $empresa->id, 
            'nombre' => 'Chancado Primario', 
            'ubicacion' => 'Bloque A',
        ]); // ID 1

        Planta::create([
            'empresa_id' => $empresa->id, 
            'nombre' => 'Chancado Secundario', 
            'ubicacion' => 'Bloque B',
        ]); // ID 2

        Planta::create([
            'empresa_id' => $empresa->id, 
            'nombre' => 'Planta Concentradora', 
            'ubicacion' => 'Bloque C',
        ]); // ID 3

        Planta::create([
            'empresa_id' => $empresa->id, 
            'nombre' => 'Almacén Central', 
            'ubicacion' => 'Bloque D',
        ]); // ID 4
        
        // Creamos una segunda empresa y planta para demostrar el aislamiento total (SaaS)
        $empresa2 = Empresa::create([
            'nombre' => 'Minera Global Ltda.',
            'rut' => '80.000.000-0',
        ]);

        Planta::create([
            'empresa_id' => $empresa2->id, 
            'nombre' => 'Planta Procesadora Remota', 
            'ubicacion' => 'Norte',
        ]); // ID 5
    }
}