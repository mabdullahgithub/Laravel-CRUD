<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Faker\Factory as Faker;
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() : array
    {
        $faker = Faker::create();

        return [
            'name' => $faker->name(),
            'description' => $faker->paragraph(),
            'image' => $faker->image('public/images', 640, 480, null, false),
        ];
    }
}