{{-- resources/views/reportes/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Reporte Diario de Producción') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <h3 class="text-lg font-medium text-gray-900 mb-4">
                    Reporte para la Planta ID: {{ auth()->user()->planta_id }}
                </h3>

                <form method="POST" action="{{ route('reportes.store') }}">
                    @csrf

                    <div class="mt-4">
                        <x-input-label for="fecha" :value="__('Fecha del Reporte')" />
                        <x-text-input id="fecha" class="block mt-1 w-full" type="date" name="fecha" :value="old('fecha')" required autofocus />
                        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="tonelaje_procesado" :value="__('Tonelaje Procesado (ton)')" />
                        <x-text-input id="tonelaje_procesado" class="block mt-1 w-full" type="number" step="0.01" name="tonelaje_procesado" :value="old('tonelaje_procesado')" required />
                        <x-input-error :messages="$errors->get('tonelaje_procesado')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="ley_mineral" :value="__('Ley Mineral (%)')" />
                        <x-text-input id="ley_mineral" class="block mt-1 w-full" type="number" step="0.0001" name="ley_mineral" :value="old('ley_mineral')" required />
                        <x-input-error :messages="$errors->get('ley_mineral')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button>
                            {{ __('Guardar Reporte') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>