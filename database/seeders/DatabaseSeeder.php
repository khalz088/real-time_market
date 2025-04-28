<?php

namespace Database\Seeders;

use App\Models\Agricultural_product;
use App\Models\Category;
use App\Models\Market_price;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\Agricultural_productFactory;
use Database\Factories\MarketFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         Category::factory(10)->create();
//         Agricultural_product::factory(10)->create();
//         Market_price::factory(10)->create();





//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
