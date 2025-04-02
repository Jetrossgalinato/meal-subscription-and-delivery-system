<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meal; // Import the Meal model

class MealController extends Controller
{
    public function getMeals()
    {
        $meals = Meal::all();

        return response()->json($meals);
    }
}
