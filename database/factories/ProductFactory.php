<?php

namespace Database\Factories;

use App\Enums\ProductBadge;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    private static int $order = 1;

    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);
        $price = fake()->randomFloat(2, 10, 5000);
        $hasDiscount = fake()->boolean(30);

        return [
            'category_id' => Category::factory(),
            'name' => ucfirst($name),
            'slug' => Str::slug($name) . '-' . self::$order++,
            'description' => fake()->paragraphs(2, true),
            'price' => $price,
            'original_price' => $hasDiscount ? $price + fake()->randomFloat(2, 5, $price * 0.5) : null,
            'sku' => strtoupper(Str::random(8)),
            'stock' => fake()->numberBetween(0, 100),
            'image_url' => 'https://picsum.photos/seed/product-' . self::$order . '/600/400',
            'badge' => fake()->optional(0.4)->randomElement(ProductBadge::cases())?->value,
            'is_active' => true,
            'is_featured' => fake()->boolean(20),
            'rating' => fake()->randomFloat(2, 1, 5),
            'reviews_count' => fake()->numberBetween(0, 200),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
            'badge' => ProductBadge::SoldOut->value,
        ]);
    }

    public function forCategory(Category $category): static
    {
        return $this->state(fn (array $attributes) => [
            'category_id' => $category->id,
        ]);
    }
}
