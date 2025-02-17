<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Plato') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('dishes.update', $dish) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Plato</label>
                                <input type="text" name="name" id="name" value="{{ $dish->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ $dish->description }}</textarea>
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                                <input type="number" step="0.01" name="price" id="price" value="{{ $dish->price }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            </div>

                            <div>
                                <label for="image_main" class="block text-sm font-medium text-gray-700">Imagen Principal</label>
                                @if($dish->image_main)
                                    <img src="{{ Storage::url($dish->image_main) }}" alt="Imagen actual" class="w-32 h-32 object-cover mb-2">
                                @endif
                                <input type="file" name="image_main" id="image_main" class="mt-1 block w-full" accept="image/*">
                            </div>

                            <div>
                                <label for="additional_images" class="block text-sm font-medium text-gray-700">Imágenes Adicionales</label>
                                @if($dish->additional_images)
                                    <div class="grid grid-cols-4 gap-2 mb-2">
                                        @foreach($dish->additional_images as $image)
                                            <img src="{{ Storage::url($image) }}" alt="Imagen adicional" class="w-24 h-24 object-cover">
                                        @endforeach
                                    </div>
                                @endif
                                <input type="file" name="additional_images[]" id="additional_images" class="mt-1 block w-full" multiple accept="image/*">
                            </div>

                            <div class="flex items-center gap-4">
                                <div>
                                    <input type="checkbox" name="is_special" id="is_special" class="rounded border-gray-300" {{ $dish->is_special ? 'checked' : '' }}>
                                    <label for="is_special" class="ml-2 text-sm font-medium text-gray-700">Plato Especial</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="is_available" id="is_available" class="rounded border-gray-300" {{ $dish->is_available ? 'checked' : '' }}>
                                    <label for="is_available" class="ml-2 text-sm font-medium text-gray-700">Disponible</label>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Actualizar Plato
                                </button>
                                <a href="{{ route('dishes.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
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