<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        try {
            $user = auth()->user();
            $validated = $request->validate([
                'items' => 'required|array',
                'location' => 'required|string',
                'delivery_fee' => 'required|numeric',
            ]);

            // Save order
            $order = DB::table('orders')->insertGetId([
                'user_id' => $user->id,
                'status' => 'unpaid',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Save order items
            foreach ($validated['items'] as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $order,
                    'meal_id' => $item['meal_id'],
                    'quantity' => $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Stripe setup
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $lineItems = [];
            foreach ($validated['items'] as $item) {
                $meal = DB::table('meals')->find($item['meal_id']);
                if (!$meal) {
                    return response()->json(['error' => 'Meal not found'], 404);
                }
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => ['name' => $meal->name],
                        'unit_amount' => intval($meal->price * 100),
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            // Add delivery fee as a line item
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Delivery Fee'],
                    'unit_amount' => intval($validated['delivery_fee'] * 100), // Convert to cents
                ],
                'quantity' => 1, // Only one delivery fee
            ];

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => env('APP_URL') . '/checkout/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => env('APP_URL') . '/checkout/cancel',
                'metadata' => [
                    'order_id' => $order,
                    'user_id' => $user->id,
                    'location' => $validated['location'], // Include location in metadata
                ],
            ]);

            return response()->json(['checkout_url' => $session->url]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Checkout error: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred during checkout'], 500);
        }
    }
}
