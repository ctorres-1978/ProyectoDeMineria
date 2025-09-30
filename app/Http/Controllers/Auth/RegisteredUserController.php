<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role; // <-- Necesario para obtener roles
use App\Providers\RouteServiceProvider; // Necesario para redirigir
use App\Models\Empresa; // <-- Necesario para obtener empresas
use App\Models\Planta; // <-- Necesario para obtener plantas

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // 1. Aplicar blindaje de seguridad: Solo usuarios con permiso 'manage_users' pueden acceder.
        $this->authorize('manage_users'); 

        // 2. Obtener datos necesarios para el formulario
        $roles = Role::pluck('name', 'name'); 
        $empresas = Empresa::pluck('nombre', 'id');
        $plantas = Planta::pluck('nombre', 'id');

        // Retornamos la vista con todos los datos
        return view('auth.register', compact('roles', 'empresas', 'plantas'));
    }

    /**
     * Handle an incoming registration request.
     * Modificado para asignar Empresa, Planta y Rol (RBAC/SaaS).
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Aplicar blindaje de seguridad: Solo usuarios con permiso 'manage_users' pueden crear.
        $this->authorize('manage_users');

        // 2. Validación de Datos (Nuevos campos SaaS/RBAC)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            // ** CAMPOS DE ASIGNACIÓN (SaaS / RBAC) **
            'empresa_id' => ['required', 'exists:empresas,id'],
            'planta_id' => ['required', 'exists:plantas,id'],
            'role_name' => ['required', 'exists:roles,name'], // Debe coincidir con un rol de Spatie
        ]);

        // 3. Creación del Usuario con Asignación de IDs
        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
            // Asignación de IDs SaaS
            'empresa_id' => $request->empresa_id,
            'planta_id' => $request->planta_id,
        ]);

        // 4. Asignación del Rol con Spatie
        $user->assignRole($request->role_name); 

        // 5. Redirección (Quitamos Auth::login($user) para que el Admin no se loguee como el nuevo usuario)
        event(new Registered($user));
        
        return redirect(RouteServiceProvider::HOME)
               ->with('success', 'Usuario creado y rol asignado correctamente.');
    }
}
