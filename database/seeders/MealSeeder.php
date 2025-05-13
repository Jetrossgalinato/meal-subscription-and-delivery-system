<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meal::create([
            'name' => 'Grilled Chicken Salad',
            'description' => 'A healthy salad with grilled chicken, fresh greens, and a light vinaigrette.',
            'price' => 12.99,
            'image' => 'images/chickensalad.jpeg', // Relative path from the public directory
        ]);

        Meal::create([
            'name' => 'Spaghetti Bolognese',
            'description' => 'Classic Italian pasta with a rich meat sauce.',
            'price' => 15.99,
            'image' => 'images/spagbolognese.jpg', // Relative path from the public directory
        ]);

        Meal::create([
            'name' => 'Vegetarian Pizza',
            'description' => 'A delicious pizza topped with fresh vegetables and mozzarella cheese.',
            'price' => 10.99,
            'image' => 'images/vegetarianpizza.jpg', // Relative path from the public directory
        ]);
    }
}