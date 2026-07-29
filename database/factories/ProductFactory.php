<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    private static int $order = 1;

    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        $price = fake()->randomFloat(2, 10, 5000);
        $daysSinceChange = fake()->numberBetween(1, 60);
        $isStabilized = $daysSinceChange >= 30;

        // If price is stabilized, set original_price = price (baseline)
        $originalPrice = $isStabilized ? $price : null;

        // Some stabilized products get a discount applied (current price < original)
        if ($isStabilized && fake()->boolean(30)) {
            $discountPct = fake()->randomFloat(2, 5, 40);
            $price = round($originalPrice * (1 - $discountPct / 100), 2);
        }

        return [
            'category_id' => Category::factory(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name) . '-' . self::$order++,
            'description' => fake()->paragraphs(2, true),
            'price' => $price,
            'original_price' => $originalPrice,
            'sku' => strtoupper(Str::random(8)),
            'stock' => fake()->numberBetween(0, 100),
            'image_url' => 'https://picsum.photos/seed/product-' . self::$order . '/600/400',
            'is_active' => true,
            'is_featured' => fake()->boolean(20),
            'price_changed_at' => now()->subDays($daysSinceChange),
            'rating' => fake()->randomFloat(2, 1, 5),
            'reviews_count' => fake()->numberBetween(0, 200),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn () => [
            'is_featured' => true,
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['is_active' => false]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn () => ['stock' => 0]);
    }

    public function forCategory(Category $category): static
    {
        return $this->state(fn () => ['category_id' => $category->id]);
    }
}
