<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agricultural_product>
 */
class Agricultural_productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'description' => $this->faker->paragraph(),
            'measurement_unit' => $this->faker->randomElement(['kg', 'lb', 'ton', 'piece', 'bushel']),
            'seasonal' => $this->faker->numberBetween(0, 1),  // Explicitly 0 or 1
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
