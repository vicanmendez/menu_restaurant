<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::all();
        return view('dishes.index', compact('dishes'));
    }

    public function create()
    {
        return view('dishes.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'image_main' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            ], [
                'name.required' => 'El nombre del plato es obligatorio',
                'description.required' => 'La descripción es obligatoria',
                'price.required' => 'El precio es obligatorio',
                'price.numeric' => 'El precio debe ser un número',
                'price.min' => 'El precio no puede ser negativo',
                'image_main.required' => 'La imagen principal es obligatoria',
                'image_main.image' => 'El archivo debe ser una imagen',
                'image_main.mimes' => 'La imagen debe ser de tipo: jpeg, jpg, png o gif',
                'image_main.max' => 'La imagen no debe pesar más de 2MB'
            ]);

            // Manejar los checkboxes - convertimos explícitamente a booleano
            $validated['is_special'] = (bool)$request->input('is_special', false);
            $validated['is_available'] = (bool)$request->input('is_available', true);

            // Guardar la imagen principal
            if ($request->hasFile('image_main')) {
                $path = $request->file('image_main')->store('dishes', 'public');
                if (!$path) {
                    throw new \Exception('Error al guardar la imagen principal');
                }
                $validated['image_main'] = $path;
            }

            // Guardar imágenes adicionales si existen
            if ($request->hasFile('additional_images')) {
                $additionalImages = [];
                foreach ($request->file('additional_images') as $image) {
                    $path = $image->store('dishes', 'public');
                    if (!$path) {
                        throw new \Exception('Error al guardar una imagen adicional');
                    }
                    $additionalImages[] = $path;
                }
                $validated['additional_images'] = $additionalImages;
            } else {
                $validated['additional_images'] = []; // Aseguramos que siempre haya un valor para additional_images
            }

            $dish = Dish::create($validated);

            if (!$dish) {
                throw new \Exception('Error al crear el plato en la base de datos');
            }

            return redirect()
                ->route('dishes.index')
                ->with('success', 'El plato se ha creado exitosamente');

        } catch (\Exception $e) {
            // Registrar el error para debugging
            Log::error('Error creando plato: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Hubo un error al crear el plato: ' . $e->getMessage()]);
        }
    }

    public function edit(Dish $dish)
    {
        return view('dishes.edit', compact('dish'));
    }

    public function update(Request $request, Dish $dish)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'image_main' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
                'additional_images.*' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            ], [
                'name.required' => 'El nombre del plato es obligatorio',
                'description.required' => 'La descripción es obligatoria',
                'price.required' => 'El precio es obligatorio',
                'price.numeric' => 'El precio debe ser un número',
                'price.min' => 'El precio no puede ser negativo',
                'image_main.image' => 'El archivo debe ser una imagen',
                'image_main.mimes' => 'La imagen debe ser de tipo: jpeg, jpg, png o gif',
                'image_main.max' => 'La imagen no debe pesar más de 2MB'
            ]);

            // Manejar los checkboxes
            $validated['is_special'] = (bool)$request->input('is_special', false);
            $validated['is_available'] = (bool)$request->input('is_available', true);

            // Guardar la imagen principal si se proporciona una nueva
            if ($request->hasFile('image_main')) {
                // Eliminar la imagen anterior
                if ($dish->image_main) {
                    Storage::disk('public')->delete($dish->image_main);
                }
                
                $path = $request->file('image_main')->store('dishes', 'public');
                if (!$path) {
                    throw new \Exception('Error al guardar la imagen principal');
                }
                $validated['image_main'] = $path;
            } else {
                // Si no se proporciona una nueva imagen, mantener la existente
                unset($validated['image_main']);
            }

            // Guardar imágenes adicionales si existen
            if ($request->hasFile('additional_images')) {
                // Eliminar imágenes adicionales anteriores
                if ($dish->additional_images) {
                    foreach ($dish->additional_images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }

                $additionalImages = [];
                foreach ($request->file('additional_images') as $image) {
                    $path = $image->store('dishes', 'public');
                    if (!$path) {
                        throw new \Exception('Error al guardar una imagen adicional');
                    }
                    $additionalImages[] = $path;
                }
                $validated['additional_images'] = $additionalImages;
            }

            $dish->update($validated);

            return redirect()
                ->route('dishes.index')
                ->with('success', 'El plato se ha actualizado exitosamente');

        } catch (\Exception $e) {
            // Registrar el error para debugging
            Log::error('Error actualizando plato: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Hubo un error al actualizar el plato: ' . $e->getMessage()]);
        }
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('dishes.index')->with('success', 'Dish deleted successfully');
    }
}
