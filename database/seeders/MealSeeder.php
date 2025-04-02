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
            'image' => 'images/grilled-chicken-salad.jpg',
        ]);

        Meal::create([
            'name' => 'Spaghetti Bolognese',
            'description' => 'Classic Italian pasta with a rich meat sauce.',
            'price' => 15.99,
            'image' => 'images/spaghetti-bolognese.jpg',
        ]);

        Meal::create([
            'name' => 'Vegetarian Pizza',
            'description' => 'A delicious pizza topped with fresh vegetables and mozzarella cheese.',
            'price' => 10.99,
            'image' => 'images/vegetarian-pizza.jpg',
        ]);
    }
}
