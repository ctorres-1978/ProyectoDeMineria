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

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'], // REQUERIDO
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            // VALIDACIÓN DE ROLES
            'role' => ['required', 'string', 'in:admin,chancado_primario,concentradora,operario'], 
            
            // VALIDACIÓN DE ÁREAS (INCLUYE AMBAS BODEGAS SEPARADAS)
            'area' => ['required', 'string', 'in:primario,secundario,concentradora,despacho,insumos,herramientas'], 
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellido' => $request->apellido, // GUARDAR APELLIDO
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // GUARDAR ROL
            'area' => $request->area, // GUARDAR ÁREA
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
