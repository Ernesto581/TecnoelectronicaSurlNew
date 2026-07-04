<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
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

        $customer = User::factory()->customer()->create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
        ]);

        $categories = Category::factory(6)->create();

        $products = collect();
        foreach ($categories as $category) {
            $products = $products->merge(
                Product::factory(5)
                    ->forCategory($category)
                    ->create()
            );

            $products = $products->merge(
                Product::factory(2)
                    ->featured()
                    ->forCategory($category)
                    ->create()
            );
        }

        $cart = Order::factory()->cart()->create([
            'user_id' => $customer->id,
        ]);

        $sampleProducts = $products->random(3);
        foreach ($sampleProducts as $product) {
            OrderItem::factory()->forProduct($product, rand(1, 3))->create([
                'order_id' => $cart->id,
            ]);
        }
        $cart->recalculateTotals();

        $completed = Order::factory()->delivered()->create([
            'user_id' => $customer->id,
        ]);

        $pastProducts = $products->random(2);
        foreach ($pastProducts as $product) {
            OrderItem::factory()->forProduct($product, rand(1, 2))->create([
                'order_id' => $completed->id,
            ]);
        }
        $completed->recalculateTotals();
    }
}
