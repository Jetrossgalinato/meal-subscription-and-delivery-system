<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Meal;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Add a meal to the cart
    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'meal_id' => 'required|integer|exists:meals,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(), // Assuming the user is authenticated
                'meal_id' => $validated['meal_id'],
            ],
            [
                'quantity' => DB::raw("quantity + {$validated['quantity']}"),
            ]
        );

        return response()->json(['message' => 'Meal added to cart successfully!', 'cartItem' => $cartItem]);
    }

    // Get all cart items for the authenticated user
    public function getCartItems()
    {
        $cartItems = Cart::with('meal') // Assuming a relationship between Cart and Meal
            ->where('user_id', auth()->id())
            ->get();

        return response()->json($cartItems);
    }

    // Remove a meal from the cart
    public function removeFromCart($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', auth()->id())->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Meal removed from cart successfully!']);
    }
}
