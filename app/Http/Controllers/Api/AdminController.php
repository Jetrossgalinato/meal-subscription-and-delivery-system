<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Meal;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        try {
            return response()->json([
                'data' => [
                    'total_users' => User::count(), // Count total users
                    'total_meals' => Meal::count(), // Count total meals
                    'recent_users' => User::latest()->take(5)->get(), // Fetch 5 most recent users
                ],
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in AdminController@index: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
}
