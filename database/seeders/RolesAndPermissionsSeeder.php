<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ----------------------------------------------------
        // 1. DEFINICIÓN DE PERMISOS (BLINDAJE DE SEGURIDAD)
        // ----------------------------------------------------

        // Permisos de Administración (SaaS)
        Permission::create(['name' => 'manage_saas']); 
        Permission::create(['name' => 'manage_users']); 

        // Permisos de Módulo Operaciones (Fase 2)
        Permission::create(['name' => 'report_diario']); 
        Permission::create(['name' => 'review_reporte_planta']); 
        Permission::create(['name' => 'review_all_reportes']); 
        
        // Permisos Financieros (Blindaje)
        Permission::create(['name' => 'view_costs']); 
        Permission::create(['name' => 'manage_cost_data']); 

        // ----------------------------------------------------
        // 2. DEFINICIÓN DE ROLES (Los 7 roles jerárquicos)
        // ----------------------------------------------------

        // ROL 1: Administrador de Sistema (Acceso total, SaaS)
        $role = Role::create(['name' => 'administrador']);
        $role->givePermissionTo(Permission::all());

        // ROL 2: Gerente General (Vista Financiera y Control de Usuarios)
        $role = Role::create(['name' => 'gerente_general']);
        $role->givePermissionTo(['manage_users', 'review_all_reportes', 'view_costs', 'manage_cost_data']);

        // ROL 3: Supervisor (Revisión de su Planta)
        $role = Role::create(['name' => 'supervisor']);
        $role->givePermissionTo(['report_diario', 'review_reporte_planta']);

        // ROL 4: Operario (Solo ingresar datos)
        Role::create(['name' => 'operario'])
             ->givePermissionTo('report_diario');

        // ROL 5: Jefe de Finanzas (Solo vista de Costos)
        Role::create(['name' => 'jefe_finanzas'])
             ->givePermissionTo('view_costs');

        // ROL 6: Invitado (Solo ver)
        Role::create(['name' => 'invitado']); 

        // ROL 7: Desarrollador (Acceso de debugging, igual que Admin)
        $role = Role::create(['name' => 'desarrollador']);
        $role->givePermissionTo(Permission::all());
    }
}