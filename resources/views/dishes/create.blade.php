<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Plato') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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

                    <form action="{{ route('dishes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('name') border-red-500 @enderror" 
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="3" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('description') border-red-500 @enderror" 
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                                <input type="number" 
                                       step="0.01" 
                                       name="price" 
                                       id="price" 
                                       value="{{ old('price') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('price') border-red-500 @enderror" 
                                       required>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="image_main" class="block text-sm font-medium text-gray-700">Imagen Principal</label>
                                <input type="file" 
                                       name="image_main" 
                                       id="image_main" 
                                       class="mt-1 block w-full @error('image_main') border-red-500 @enderror" 
                                       required 
                                       accept="image/*">
                                @error('image_main')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="additional_images" class="block text-sm font-medium text-gray-700">Imágenes Adicionales</label>
                                <input type="file" 
                                       name="additional_images[]" 
                                       id="additional_images" 
                                       class="mt-1 block w-full @error('additional_images.*') border-red-500 @enderror" 
                                       multiple 
                                       accept="image/*">
                                @error('additional_images.*')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center gap-4">
                                <div>
                                    <input type="checkbox" 
                                           name="is_special" 
                                           id="is_special" 
                                           class="rounded border-gray-300"
                                           {{ old('is_special') ? 'checked' : '' }}>
                                    <label for="is_special" class="ml-2 text-sm font-medium text-gray-700">Plato Especial</label>
                                </div>
                                <div>
                                    <input type="checkbox" 
                                           name="is_available" 
                                           id="is_available" 
                                           class="rounded border-gray-300" 
                                           {{ old('is_available', true) ? 'checked' : '' }}>
                                    <label for="is_available" class="ml-2 text-sm font-medium text-gray-700">Disponible</label>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Crear Plato
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
