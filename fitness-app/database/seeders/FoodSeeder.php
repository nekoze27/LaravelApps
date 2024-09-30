<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $foods = config('models.seeding.food.default_list');

        // if (is_null($foods)) {
        //     throw new \Exception('Food configuration not found.');
        // }

        // foreach ($foods as $food) {
        //     Food::create($food);
        // }
        $seedConfig = config('models.seeding.food');
        $foodItems = $seedConfig['default_list'];

        foreach ($foodItems as $foodItem) {
            Food::updateOrCreate(
                [
                    'name' => $foodItem['name'],
                ],
                [
                    'protein' => $foodItem['protein'],
                    'carbs' => $foodItem['carbs'],
                    'fat' => $foodItem['fat'],
                    'grams' => $foodItem['fat'],
                ]
            );
        }

        $useFactory = $seedConfig['factory'];
        $factoryCount = $seedConfig['factory_count'];

        if ($useFactory) {
            Food::factory()->count($factoryCount)->create();
        }
    }
}
