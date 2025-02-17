<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestionar Platos') }}
            </h2>
            <a href="{{ route('dishes.create') }}" 
               class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Añadir Nuevo Plato
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($dishes->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">No hay platos disponibles.</p>
                            <a href="{{ route('dishes.create') }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                                Crear Tu Primer Plato
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($dishes as $dish)
                                <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                                    <img src="{{ Storage::url($dish->image_main) }}" 
                                         alt="{{ $dish->name }}" 
                                         class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="text-lg font-semibold">{{ $dish->name }}</h3>
                                            <span class="text-lg font-bold">${{ number_format($dish->price, 2) }}</span>
                                        </div>
                                        <p class="text-gray-600 mb-4">{{ Str::limit($dish->description, 100) }}</p>
                                        <div class="flex justify-between items-center">
                                            <span class="px-2 py-1 rounded-full text-sm {{ $dish->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $dish->is_available ? 'Disponible' : 'No Disponible' }}
                                            </span>
                                            <div class="space-x-2">
                                                <a href="{{ route('dishes.edit', $dish) }}" 
                                                   class="text-blue-600 hover:text-blue-900">Editar</a>
                                                <form action="{{ route('dishes.destroy', $dish) }}" 
                                                      method="POST" 
                                                      class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="text-red-600 hover:text-red-900" 
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este plato?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
