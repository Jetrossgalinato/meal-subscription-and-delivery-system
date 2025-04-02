<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'message' => 'Welcome to the Admin Dashboard',
            'data' => [
                'total_users' => \App\Models\User::count(),
                'total_meals' => \App\Models\Meal::count(),
                'recent_users' => \App\Models\User::latest()->take(5)->get(),
            ],
        ]);
    }
}
