<?php

namespace Database\Factories;

use App\Models\Agricultural_product;
use App\Models\Market_price;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class Market_priceFactory extends Factory
{
    protected $model = Market_price::class;

    public function definition(): array
    {
        return [
            'wholesale_price' => $this->faker->randomFloat(2, 1, 1000),  // 2 decimal places, between 1-1000
            'retail_price' => $this->faker->randomFloat(2, 1, 1500),     // Slightly higher than wholesale
            'quantity_available' => $this->faker->randomFloat(2, 0, 5000),
            'is_organic' =>  $this->faker->numberBetween(0, 1),
            'price_trend' => $this->faker->randomElement(['up', 'down', 'stable']),
            'price_change_percent' => $this->faker->randomFloat(2, -50, 50), // -50% to +50%
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'agricultural_product_id' => Agricultural_product::factory(),
            'user_id' => User::factory()
        ];
    }
}
