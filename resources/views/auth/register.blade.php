<x-guest-elegante>
    
    <form method="POST" action="{{ route('user.store') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="apellido" :value="__('Apellido')" />
            <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required autocomplete="apellido" />
            <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="role" :value="__('Jerarquía y Rol')" />
            <select id="role" name="role" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Seleccione el Rol</option>
                <option value="admin">1. Administrador </option>
                <option value="chancado_primario">2. Jefe - Chancado Primario</option>
                <option value="concentradora">2. Jefe - Concentradora</option>
                <option value="jefe_bodegas">2. Jefe - Bodegas</option>
                <option value="jefe_despacho">2. Jefe - Despacho</option>
                <option value="operario">3. Operario de Área</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="area" :value="__('Área de Pertenencia')" />
            <select id="area" name="area" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="" disabled selected>Seleccione el Área</option>
                <option value="primario">Chancador Primario</option>
                <option value="secundario">Chancador Secundario</option>
                <option value="concentradora">Concentradora</option>
                <option value="despacho">Despacho</option>
                <option value="insumos">Bodega de Insumos</option>
                <option value="herramientas">Bodega de Herramientas</option>
            </select>
            <x-input-error :messages="$errors->get('area')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya está registrado?') }}
            </a>

            <x-primary-button class="ms-4 bg-[#b07c64] hover:bg-[#9a6a58] focus:bg-[#9a6a58] active:bg-[#9a6a58] border-transparent">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-elegante>