<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nueva Orden') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <strong>¡Por favor corrija los siguientes errores!</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700">
                                    Nombre del Cliente
                                </label>
                                <input type="text" 
                                       name="customer_name" 
                                       id="customer_name" 
                                       value="{{ old('customer_name') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                                       required>
                            </div>

                            <div>
                                <label for="order_type" class="block text-sm font-medium text-gray-700">
                                    Tipo de Orden
                                </label>
                                <select name="order_type" 
                                        id="order_type" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="dine-in" {{ old('order_type') === 'dine-in' ? 'selected' : '' }}>
                                        Para comer aquí
                                    </option>
                                    <option value="takeaway" {{ old('order_type') === 'takeaway' ? 'selected' : '' }}>
                                        Para llevar
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Seleccionar Platos
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($dishes as $dish)
                                        <div class="border rounded-lg p-4">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <h3 class="font-semibold">{{ $dish->name }}</h3>
                                                    <p class="text-sm text-gray-600">${{ number_format($dish->price, 2) }}</p>
                                                </div>
                                                <input type="number" 
                                                       name="items[{{ $dish->id }}][quantity]" 
                                                       value="{{ old('items.' . $dish->id . '.quantity', 0) }}"
                                                       min="0" 
                                                       class="w-20 rounded-md border-gray-300 shadow-sm">
                                                <input type="hidden" 
                                                       name="items[{{ $dish->id }}][dish_id]" 
                                                       value="{{ $dish->id }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label for="special_instructions" class="block text-sm font-medium text-gray-700">
                                    Instrucciones Especiales
                                </label>
                                <textarea name="special_instructions" 
                                          id="special_instructions" 
                                          rows="3" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('special_instructions') }}</textarea>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Crear Orden
                                </button>
                                <a href="{{ route('orders.index') }}" 
                                   class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                                    Cancelar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
