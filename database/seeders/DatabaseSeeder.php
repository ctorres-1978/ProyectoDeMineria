<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // LLAMADA CLAVE PARA CREAR ROLES Y PERMISOS
        $this->call(RolesAndPermissionsSeeder::class); 

        // Puedes comentar o dejar la creación del usuario de prueba, pero es mejor
        // que lo borremos o comentemos para no tener conflictos con los roles.
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
    }
}