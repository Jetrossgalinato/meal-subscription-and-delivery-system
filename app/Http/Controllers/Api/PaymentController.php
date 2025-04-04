<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function payByStripe(Request $request)
    {
        // Set the Stripe API key from the .env file
        Stripe::setApiKey(env('STRIPE_SECRET')); // Use STRIPE_SECRET instead of STRIPE_KEY for security

        try {
            // Create a Stripe Checkout session
            $checkout_session = Session::create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $request->plan_name, // Use the plan name from the request
                        ],
                        'unit_amount' => $this->calculateOrderTotal($request->price), // Amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $request->success_url, // Redirect URL on success
                'cancel_url' => $request->cancel_url,   // Redirect URL on cancel
            ]);

            // Return the Checkout session URL
            return response()->json(['url' => $checkout_session->url]);
        } catch (\Exception $e) {
            // Return the error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Calculate the total order amount in cents
    public function calculateOrderTotal($price)
    {
        return $price * 100; // Convert price to cents
    }
}
