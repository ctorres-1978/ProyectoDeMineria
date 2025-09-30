<x-guest-elegante>
    <div class="p-6 text-gray-900" style="text-align: center;">
        <p style="color: #6a6a6a; margin-bottom: 30px; font-weight: 300; font-size: 1.2rem;">
            ¡Has iniciado sesión como administrador!
        </p>

        <a href="{{ route('user.create') }}" style="display: block; width: 100%; padding: 14px; background-color: #b07c64; color: white; border: none; border-radius: 8px; font-size: 18px; text-align: center; text-decoration: none; transition: background-color 0.3s, box-shadow 0.3s; margin-bottom: 15px; box-sizing: border-box;">
            Crear Nuevo Usuario
        </a>
        
        <a href="{{ route('system.home') }}" style="display: block; width: 100%; padding: 14px; background-color: #b07c64; color: white; border: none; border-radius: 8px; font-size: 18px; text-align: center; text-decoration: none; transition: background-color 0.3s, box-shadow 0.3s; margin-bottom: 15px; box-sizing: border-box;">
            Acceder al Sistema
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="display: block; width: 100%; padding: 14px; background-color: #b07c64; color: white; border: none; border-radius: 8px; font-size: 18px; text-align: center; cursor: pointer; transition: background-color 0.3s, box-shadow 0.3s; box-sizing: border-box;">
                Cerrar sesión
            </button>
        </form>
    </div>
</x-guest-elegante>