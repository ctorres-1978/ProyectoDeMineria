{{-- resources/views/reportes/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Módulo de Operaciones | Reportes Diarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        @if (auth()->user()->can('review_all_reportes'))
                            Acceso Gerencial: Viendo reportes de TODAS las plantas.
                        @else
                            Viendo reportes de la Planta ID: {{ auth()->user()->planta_id }}
                        @endif
                    </h3>
                    
                    <p class="mt-4">La lógica de aislamiento por Planta está funcionando correctamente. Aquí se listarán los reportes.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>