<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $dishes = Dish::where('is_available', true)->get();
        return view('orders.create', compact('dishes'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'order_type' => 'required|in:dine-in,takeaway',
                'items' => 'required|array',
                'special_instructions' => 'nullable|string',
            ], [
                'customer_name.required' => 'El nombre del cliente es obligatorio',
                'order_type.required' => 'El tipo de orden es obligatorio',
                'order_type.in' => 'El tipo de orden debe ser para comer aquí o para llevar',
            ]);

            // Calcular el total y formatear los items
            $total = 0;
            $subtotal = 0;
            $formattedItems = [];
            
            foreach ($request->input('items', []) as $itemId => $item) {
                if (!empty($item['quantity']) && $item['quantity'] > 0) {
                    $dish = Dish::findOrFail($item['dish_id']);
                    $itemSubtotal = $dish->price * $item['quantity'];
                    $subtotal += $itemSubtotal;
                    $total += $itemSubtotal;
                    
                    $formattedItems[] = [
                        'dish_id' => $dish->id,
                        'name' => $dish->name,
                        'price' => $dish->price,
                        'quantity' => $item['quantity'],
                        'subtotal' => $itemSubtotal
                    ];
                }
            }

            if (empty($formattedItems)) {
                throw new \Exception('Debe seleccionar al menos un plato con cantidad mayor a 0');
            }

            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'order_type' => $validated['order_type'],
                'items' => $formattedItems,
                'total' => $total,
                'subtotal' => $subtotal,
                'special_instructions' => $validated['special_instructions'] ?? null,
                'status' => 'pending'
            ]);

            return redirect()
                ->route('orders.index')
                ->with('success', 'La orden se ha creado exitosamente');

        } catch (\Exception $e) {
            Log::error('Error creando orden: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Hubo un error al crear la orden: ' . $e->getMessage()]);
        }
    }

    public function edit(Order $order)
    {
        $dishes = Dish::where('is_available', true)->get();
        return view('orders.edit', compact('order', 'dishes'));
    }

    public function update(Request $request, Order $order)
    {
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'order_type' => 'required|in:dine-in,takeaway',
                'items' => 'required|array',
                'special_instructions' => 'nullable|string',
                'status' => 'required|in:pending,preparing,completed,cancelled',
            ], [
                'customer_name.required' => 'El nombre del cliente es obligatorio',
                'order_type.required' => 'El tipo de orden es obligatorio',
                'order_type.in' => 'El tipo de orden debe ser para comer aquí o para llevar',
                'status.required' => 'El estado de la orden es obligatorio',
                'status.in' => 'El estado de la orden no es válido',
            ]);

            // Calcular el total y formatear los items
            $total = 0;
            $formattedItems = [];
            
            foreach ($request->input('items', []) as $itemId => $item) {
                if (!empty($item['quantity']) && $item['quantity'] > 0) {
                    $dish = Dish::findOrFail($item['dish_id']);
                    $subtotal = $dish->price * $item['quantity'];
                    $total += $subtotal;
                    
                    $formattedItems[] = [
                        'dish_id' => $dish->id,
                        'name' => $dish->name,
                        'price' => $dish->price,
                        'quantity' => $item['quantity'],
                        'subtotal' => $subtotal
                    ];
                }
            }

            if (empty($formattedItems)) {
                throw new \Exception('Debe seleccionar al menos un plato con cantidad mayor a 0');
            }

            $order->update([
                'customer_name' => $validated['customer_name'],
                'order_type' => $validated['order_type'],
                'items' => $formattedItems,
                'total' => $total,
                'special_instructions' => $validated['special_instructions'] ?? null,
                'status' => $validated['status']
            ]);

            return redirect()
                ->route('orders.index')
                ->with('success', 'La orden se ha actualizado exitosamente');

        } catch (\Exception $e) {
            Log::error('Error actualizando orden: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Hubo un error al actualizar la orden: ' . $e->getMessage()]);
        }
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return redirect()
                ->route('orders.index')
                ->with('success', 'La orden se ha eliminado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error eliminando orden: ' . $e->getMessage());
            
            return back()->withErrors(['error' => 'Hubo un error al eliminar la orden']);
        }
    }
}