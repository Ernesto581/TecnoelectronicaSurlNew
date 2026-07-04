<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 50, 5000);

        return [
            'user_id' => User::factory(),
            'status' => fake()->randomElement(OrderStatus::cases()),
            'subtotal' => $subtotal,
            'total' => $subtotal,
            'shipping_address' => fake()->streetAddress(),
            'shipping_city' => fake()->city(),
            'shipping_state' => fake()->state(),
            'shipping_zip' => fake()->postcode(),
            'shipping_country' => fake()->country(),
            'notes' => fake()->optional()->sentence(),
        ];
    }

    public function cart(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OrderStatus::Cart,
            'shipping_address' => null,
            'shipping_city' => null,
            'shipping_state' => null,
            'shipping_zip' => null,
            'shipping_country' => null,
            'notes' => null,
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OrderStatus::Pending,
        ]);
    }

    public function delivered(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OrderStatus::Delivered,
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => OrderStatus::Cancelled,
        ]);
    }
}
