<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontController extends Controller
{
    public function index()
    {
        $dishes = Dish::where('is_available', true)->get();
        return view('welcome', compact('dishes'));
    }

    public function show(Dish $dish)
    {
        // Obtener platos relacionados
        $relatedDishes = Dish::where('is_available', true)
                            ->where('id', '!=', $dish->id)
                            ->inRandomOrder()
                            ->limit(4)
                            ->get();

        return view('item', compact('dish', 'relatedDishes'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function storeOrder(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'order_type' => 'required|in:dine-in,takeaway',
                'items' => 'required|array',
                'items.*.id' => 'required|exists:dishes,id',
                'items.*.quantity' => 'required|integer|min:1',
                'special_instructions' => 'nullable|string',
            ], [
                'customer_name.required' => 'El nombre del cliente es obligatorio',
                'order_type.required' => 'El tipo de orden es obligatorio',
                'order_type.in' => 'El tipo de orden debe ser para comer aquí o para llevar',
                'items.required' => 'El carrito está vacío',
            ]);

            $total = 0;
            $formattedItems = [];

            foreach ($validated['items'] as $item) {
                $dish = Dish::findOrFail($item['id']);
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

            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'order_type' => $validated['order_type'],
                'items' => $formattedItems,
                'total' => $total,
                'subtotal' => $total,
                'special_instructions' => $validated['special_instructions'] ?? null,
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => '¡Orden creada exitosamente!',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            Log::error('Error creando orden desde el front: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al crear la orden: ' . $e->getMessage()
            ], 422);
        }
    }

    public function updateCart(Request $request)
    {
        // Lógica para actualizar el carrito
        // Esto es solo un ejemplo
        $cart = session('cart', []);
        $cart[] = $request->item;
        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'message' => 'Carrito actualizado',
            'cart' => $cart
        ]);
    }

}
