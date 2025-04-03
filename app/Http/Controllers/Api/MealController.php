<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meal; // Import the Meal model
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function getMeals()
    {
        $meals = Meal::all();

        // Append the full URL to the image path
        $meals->transform(function ($meal) {
            $meal->image = url('storage/' . $meal->image); // Assuming images are stored in the 'storage' directory
            return $meal;
        });

        return response()->json($meals);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('meals', 'public');

        Meal::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return response()->json(['message' => 'Meal uploaded successfully!'], 201);
    }
}
