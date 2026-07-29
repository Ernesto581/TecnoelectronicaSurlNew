<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    protected $model = ContactMessage::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'message' => fake()->paragraphs(2, true),
            'is_resolved' => fake()->boolean(30),
        ];
    }

    public function resolved(): static
    {
        return $this->state(fn () => ['is_resolved' => true]);
    }

    public function unresolved(): static
    {
        return $this->state(fn () => ['is_resolved' => false]);
    }
}
