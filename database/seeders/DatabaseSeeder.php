<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        User::factory()->customer()->create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
        ]);

        $categories = Category::factory(6)->create();

        foreach ($categories as $category) {
            Product::factory(5)
                ->forCategory($category)
                ->create();

            Product::factory(2)
                ->featured()
                ->forCategory($category)
                ->create();
        }
    }
}
