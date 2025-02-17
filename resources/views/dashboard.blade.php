<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Dishes Management Card -->
                        <a href="{{ route('dishes.index') }}" class="block">
                            <div class="p-6 bg-white border rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                <h3 class="text-lg font-semibold mb-4">Gestionar Platos</h3>
                                <p class="text-gray-600 mb-4">Añade, edita y gestiona los platos de tu restaurante.</p>
                                <div class="text-blue-500 font-medium">
                                    Haz clic para gestionar platos →
                                </div>
                            </div>
                        </a>
                        
                        <!-- Orders Management Card -->
                        <a href="{{ route('orders.index') }}" class="block">
                            <div class="p-6 bg-white border rounded-lg shadow-sm hover:shadow-md transition-shadow">
                                <h3 class="text-lg font-semibold mb-4">Gestionar Pedidos</h3>
                                <p class="text-gray-600 mb-4">Ver y gestionar los pedidos de los clientes.</p>
                                <div class="text-blue-500 font-medium">
                                    Haz clic para gestionar pedidos →
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
